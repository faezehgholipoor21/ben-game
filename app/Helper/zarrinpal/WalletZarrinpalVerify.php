<?php

namespace App\Helper\zarrinpal;

use Illuminate\Support\Facades\Log;

class WalletZarrinpalVerify extends ZarrinpalHelperVerify
{

    function verify_done($verify_result, $data)
    {
        // TODO: Implement verify_done() method.

        // age shod inja
        Log::info('data =' . $data);
        Log::info('verify result wallet =' . json_encode($verify_result));
    }

    function verify_fail($verify_result, $data)
    {
        // TODO: Implement verify_fail() method.

        Log::info('verify result wallet fail = ' . json_encode($verify_result));
    }
}
