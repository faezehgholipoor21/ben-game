<?php

namespace App\Helper\zarrinpal;

use Illuminate\Http\Request;

abstract class ZarinPalHelper
{
    public function zarrinpal_request($call_back_url, $mobile, $amount, $email, $data, $gateway = 1, $description = 'بازی')
    {
        if ($gateway === 1) {
            $MerchantID = env('ZARINPAL_MERCHEND_CODE');
            $Description = $description;
            $Email = $email;
            $Amount = $amount;
            $Mobile = $mobile;
            $CallbackURL = $call_back_url;
            $ZarinGate = env('ZARINGATE', false);
            $SandBox = env('SANDBOXZARRINPAL', true);

            $result = $this->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate, $data);

            if (isset($result["code"]) && intval($result["code"]) === 100) {
                $this->success_go_to_bank($result['authority'], $result['link'], $result['data']);
            } else {
                $this->fail_to_transaction($data);
            }
        } else {
            $this->fail_to_transaction($data);
        }
    }

    protected function request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate, $my_data): array
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
                'data' => $my_data,
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
            $message = $this->fail_to_transaction($data);
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
            "data" => $my_data
        ];
    }



    abstract public function success_go_to_bank($authority, $link, $data);

    abstract public function fail_to_transaction($data);

}
