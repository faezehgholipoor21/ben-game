<?php

namespace App\Helper\zarrinpal;

use Illuminate\Support\Facades\Log;

class SubscribeZarrinpalVerify extends ZarrinpalHelperVerify
{
    function verify_done($verify_result, $data)
    {
        // TODO: Implement verify_done() method.

        Log::info( 'data=' . $data);
    }

    function verify_fail($verify_result, $data)
    {

        Log::info('data_fail=' . $data);
        // TODO: Implement verify_fail() method.
    }
}
