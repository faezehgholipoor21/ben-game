<?php

namespace App\Helper\zarrinpal;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

abstract class ZarrinpalHelperVerify
{
    function update_order_after_pay(Request $request, $is_exist, $data, $amount, $authority)
    {
//        $order_id = $request->order_id;

//        $order = Order::query()
//            ->where('id', $order_id)
//            ->where('user_id', auth()->id())
//            ->firstOrFail();

//        $products = OrderDetail::query()
//            ->with(['product'])
//            ->where('order_id', $order_id)
//            ->get();

        if ($is_exist) {
            $verify_result = $this->verify(env("ZARINPAL_MERCHEND_CODE"), $amount, $authority, true);

            if ($verify_result['code'] == 100) {

                $this->verify_done();
//                $order->update([
//                    'payment_status_id' => 2,
//                    'transaction_number' => $verify_result['ref_id'],
//                    'card_pan' => $verify_result['card_pan'],
//                ]);

            } else {
                $this->verify_fail();
//                $order->update([
//                    'payment_status_id' => 1,
//                    'transaction_number' => $verify_result['ref_id'],
//                    'card_pan' => $verify_result['card_pan'] ?? null,
//                ]);
            }
        }

        return view('site.verify.index', compact('data'));
    }

    function verify($MerchantID, $data, $authority, $SandBox = false, $ZarinGate = false): array
    {
        $ZarinGate = ($SandBox) ? false : $ZarinGate;
        $node = ($SandBox) ? "sandbox" : "ir";
        $upay = ($SandBox) ? "sandbox" : "www";

        $data = [
            'merchant_id' => $MerchantID,
            'authority' => $authority,
            'amount' => $data
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

    abstract function verify_done();

    abstract function verify_fail();
}
