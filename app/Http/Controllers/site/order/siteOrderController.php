<?php

namespace App\Http\Controllers\site\order;

use App\Http\Controllers\Controller;
use App\Models\AuthenticationPrice;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class siteOrderController extends Controller
{
    function submitOrder(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'gateway' => 'required|numeric|max:10'
        ]);

        if ($validation->fails()) {

            // error
            alert()->error('', $validation->errors()->first());
            return back();
        }

        $user = request()->user();

        $cart = $this->getCart();

        // Authentication Price Condition  **********************************************************

//        $authentication_price_info = AuthenticationPrice::query()
//            ->first();

//        if ($cart['total_price'] > $authentication_price_info['authentication_price'] and $user['status_id'] !== 2) {
//            alert()->error('', "حساب کاربری شما نیاز به احراز هویت دارد، لطفا از طریق پنل کاربری خود اقدام به احراز هویت نمایید");
//            return back();
//        }

        // Authentication Price Condition  **********************************************************

        $order = Order::query()->create([
            'order_code' => 0,
            'order_status' => 1,
            'payment_status_id' => 1,
            'total_price' => $cart['total_price'],
            'is_force' => $cart['cart'][0]['is_force'],
            'user_id' => $user->id,
            'gateway' => $input['gateway'],
        ]);

        $order_code = $order['id'] + 33000;

        $order->update([
            'order_code' => $order_code
        ]);

        foreach ($cart['cart'] as $product) {
            OrderDetail::query()->create([
                'order_id' => $order['id'],
                'product_id' => $product['product_id'],
                'count' => $product['count'],
                'bought_price' => $product['bought_price'],
            ]);
        }

        $this->deleteCart();

        if (intval($input['gateway']) === 1) {
            $MerchantID = env('ZARINPAL_MERCHEND_CODE');
            $Amount = $cart['total_price'];
            $Description = "بازی";
            $Email = "";
            $Mobile = auth()->user()->mobile;
            $CallbackURL = route('site.update_order_after_pay', ['order_id' => $order['id']]);
            $ZarinGate = false;
            $SandBox = true; //must be false

            $result = $this->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

            if (isset($result["code"]) && intval($result["code"]) === 100) {
                $order->update([
                    'authority' => $result['authority']
                ]);

                echo '<script>window.location.href="' . $result["link"] . '"</script>';

            } else {
                // error
                alert()->error('', "خطا در ایجاد تراکنش | " . $result["message"] . " | " . $result["code"]);
                return back();
            }
        } else {
            // error
            alert()->error('', "خطا در ایجاد تراکنش | مجدد تلاش کنید");
            return back();
        }
    }

    function getCart(): array
    {
        if (isset($_COOKIE['cart'])) {
            $cart = Cart::query()
                ->with(['product'])
                ->where('cookie', $_COOKIE['cart'])
                ->get();
        } else {
            $cart = [];
        }

        $total_price = 0;

        foreach ($cart as $item) {
            if ($item['is_force'] == 1) {
                $total_price += ($item['product']['product_force_price']) * $item['count'];
                $item['bought_price'] = $item['product']['product_force_price'];
            } else {
                $total_price += ($item['product']['product_price']) * $item['count'];
                $item['bought_price'] = $item['product']['product_price'];
            }
        }

        return [
            'total_price' => $total_price,
            'cart' => $cart,
        ];
    }

    function deleteCart(): void
    {
        if (isset($_COOKIE['cart'])) {
            $cart = Cart::query()
                ->with(['product'])
                ->where('cookie', $_COOKIE['cart'])
                ->get();
        } else {
            $cart = [];
        }

        foreach ($cart as $item) {
            $item->delete();
        }
    }

    function update_order_after_pay(Request $request)
    {
        $order_id = $request->order_id;

        $order = Order::query()
            ->where('id', $order_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $products = OrderDetail::query()
            ->with(['product'])
            ->where('order_id', $order_id)
            ->get();

        if ($order) {
            $verify_result = $this->verify(env("ZARINPAL_MERCHEND_CODE"), $order->total_price, $order->authority, true);

            if ($verify_result['code'] === 100) {

                $order->update([
                    'payment_status_id' => 2,
                    'transaction_number' => $verify_result['ref_id'],
                    'fee' => $verify_result['fee'],
                    'card_pan' => $verify_result['card_pan'],
                ]);

            } else {
                $order->update([
                    'payment_status_id' => 1,
                    'transaction_number' => $verify_result['ref_id'],
                    'fee' => $verify_result['fee'] ?? null,
                    'card_pan' => $verify_result['card_pan'] ?? null,
                ]);
            }
        }

        return view('site.verify.index', compact('order', 'products'));
    }

    function verify($MerchantID, $Amount, $authority, $SandBox = false, $ZarinGate = false): array
    {
        $ZarinGate = ($SandBox) ? false : $ZarinGate;
        $node = ($SandBox) ? "sandbox" : "ir";
        $upay = ($SandBox) ? "sandbox" : "www";

        $data = [
            'merchant_id' => $MerchantID,
            'authority' => $authority,
            'amount' => $Amount
        ];
        $jsonData = json_encode($data);

        $ch = curl_init("https://{$upay}.zarinpal.com/pg/v4/payment/verify.json");
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if ($err) {
            $code = 0;
            $ref_id = "";
            $card_pan = "";
            $fee = 0;
        } else {
            $code = (isset($result['data']["code"])) ? intval($result['data']["code"]) : 0;
            $ref_id = (isset($result['data']['ref_id']) && $result['data']['ref_id'] !== "") ? $result['data']['ref_id'] : "";
            $card_pan = (isset($result['data']['card_pan']) && $result['data']['card_pan'] !== "") ? $result['data']['card_pan'] : "";
            $fee = (isset($result['data']['fee']) && $result['data']['fee'] !== "") ? $result['data']['fee'] : 0;
            $err = 'No error';
        }

        return [
            "code" => $code,
            "card_pan" => $card_pan,
            "ref_id" => $ref_id,
            "fee" => $fee,
            "error" => $err,
            "result" => $result,
        ];
    }

    // ===================================================
    // === ZarinPal ======================================
    // ===================================================
    private function curl_check(): bool
    {
        return function_exists('curl_version');
    }

    private function soap_check(): bool
    {
        return extension_loaded('soap');
    }

    private function error_message($code, $desc, $cb, $request = false)
    {
        if (empty($cb) && $request === true) {
            return "لینک بازگشت ( CallbackURL ) نباید خالی باشد";
        }

        if (empty($desc) && $request === true) {
            return "توضیحات تراکنش ( Description ) نباید خالی باشد";
        }

        $error = array(
            "-1" => "اطلاعات ارسال شده ناقص است.",
            "-2" => "IP و يا مرچنت كد پذيرنده صحيح نيست",
            "-3" => "با توجه به محدوديت هاي شاپرك امكان پرداخت با رقم درخواست شده ميسر نمي باشد",
            "-4" => "سطح تاييد پذيرنده پايين تر از سطح نقره اي است.",
            "-11" => "درخواست مورد نظر يافت نشد.",
            "-12" => "امكان ويرايش درخواست ميسر نمي باشد.",
            "-21" => "هيچ نوع عمليات مالي براي اين تراكنش يافت نشد",
            "-22" => "تراكنش نا موفق ميباشد",
            "-33" => "رقم تراكنش با رقم پرداخت شده مطابقت ندارد",
            "-34" => "سقف تقسيم تراكنش از لحاظ تعداد يا رقم عبور نموده است",
            "-40" => "اجازه دسترسي به متد مربوطه وجود ندارد.",
            "-41" => "اطلاعات ارسال شده مربوط به AdditionalData غيرمعتبر ميباشد.",
            "-42" => "مدت زمان معتبر طول عمر شناسه پرداخت بايد بين 30 دقيه تا 45 روز مي باشد.",
            "-54" => "درخواست مورد نظر آرشيو شده است",
            "100" => "عمليات با موفقيت انجام گرديده است.",
            "101" => "عمليات پرداخت موفق بوده و قبلا PaymentVerification تراكنش انجام شده است.",
        );

        if (array_key_exists("{$code}", $error)) {
            return $error["{$code}"];
        } else {
            return "خطای نامشخص هنگام اتصال به درگاه زرین پال";
        }
    }

    function zarinpal_node()
    {
        if ($this->curl_check() === true) {
            $ir_ch = curl_init("https://www.zarinpal.com/pg/services/WebGate/wsdl");
            curl_setopt($ir_ch, CURLOPT_TIMEOUT, 1);
            curl_setopt($ir_ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ir_ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ir_ch);
            $ir_info = curl_getinfo($ir_ch);
            curl_close($ir_ch);

            $de_ch = curl_init("https://de.zarinpal.com/pg/services/WebGate/wsdl");
            curl_setopt($de_ch, CURLOPT_TIMEOUT, 1);
            curl_setopt($de_ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($de_ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($de_ch);
            $de_info = curl_getinfo($de_ch);
            curl_close($de_ch);

            $ir_total_time = (isset($ir_info['total_time']) && $ir_info['total_time'] > 0) ? $ir_info['total_time'] : false;
            $de_total_time = (isset($de_info['total_time']) && $de_info['total_time'] > 0) ? $de_info['total_time'] : false;

            return ($ir_total_time === false || $ir_total_time > $de_total_time) ? "de" : "ir";
        } else {
            if (function_exists('fsockopen')) {
                $de_ping = $this->zarinpal_ping("de.zarinpal.com", 80, 1);
                $ir_ping = $this->zarinpal_ping("www.zarinpal.com", 80, 1);

                $de_domain = "https://de.zarinpal.com/pg/services/WebGate/wsdl";
                $ir_domain = "https://www.zarinpal.com/pg/services/WebGate/wsdl";

                $ir_total_time = (isset($ir_ping) && $ir_ping > 0) ? $ir_ping : false;
                $de_total_time = (isset($de_ping) && $de_ping > 0) ? $de_ping : false;

                return ($ir_total_time === false || $ir_total_time > $de_total_time) ? "de" : "ir";
            } else {
                $webservice = "https://www.zarinpal.com/pg/services/WebGate/wsd";
                $headers = @get_headers($webservice);

                return (strpos($headers[0], '200') === false) ? "de" : "ir";
            }
        }
    }

    private function zarinpal_ping($host, $port, $timeout)
    {
        $time_b = microtime(true);
        $fsockopen = @fsockopen($host, $port, $errno, $errstr, $timeout);

        if (!$fsockopen) {
            return false;
        } else {
            $time_a = microtime(true);
            return round((($time_a - $time_b) * 1000), 0);
        }
    }

    public function redirect($url)
    {
        @header('Location: ' . $url);
        echo "<meta http-equiv='refresh' content='0; url={$url}' />";
        echo "<script>window.location.href = '{$url}';</script>";
        exit;
    }

    public function request($MerchantID, $Amount, $Description = "", $Email = "", $Mobile = "", $CallbackURL = "", $SandBox = false, $ZarinGate = false): array
    {
        $ZarinGate = $SandBox ? false : $ZarinGate;

        $node = $SandBox ? "sandbox" : "ir";
        $upay = $SandBox ? "sandbox" : "www";

        $data = array(
            'merchant_id' => $MerchantID,
            'amount' => $Amount,
            'description' => $Description,
            'callback_url' => $CallbackURL,
            'currency' => 'IRT',
            'metadata' => [
                'mobile' => $Mobile,
                'email' => $Email,
            ],
        );

        $jsonData = json_encode($data);
        $ch = curl_init("https://{$upay}.zarinpal.com/pg/v4/payment/request.json");
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json', 'Content-Type: application/json'));

        $result = curl_exec($ch);

        $error_msg = '';
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if ($err) {
            $code = 0;
            $message = "cURL Error #:" . $err;
            $link = "";
            $authority = '';
        } else {
            $code = (isset($result["data"]["code"]) && $result["data"]["code"] != "") ? $result["data"]["code"] : 0;
            $message = $this->error_message($code, $Description, $CallbackURL, true);
            $authority = (isset($result["data"]["authority"]) && $result["data"]["authority"] != "") ? $result["data"]["authority"] : "";
            $startPay = (isset($result["data"]["authority"]) && $result["data"]["authority"] != "") ? "https://{$upay}.zarinpal.com/pg/StartPay/" . $authority : "";
            $link = (isset($ZarinGate) && $ZarinGate) ? "{$startPay}/ZarinGate" : $startPay;
        }

        return [
            "Method" => "CURL",
            "result" => $result,
            "code" => intval($code),
            "message" => $message,
            "link" => $link,
            "authority" => $authority,
            "curl_error_msg" => $error_msg,
        ];
    }
}
