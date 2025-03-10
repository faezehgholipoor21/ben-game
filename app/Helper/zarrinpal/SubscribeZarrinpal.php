<?php

namespace App\Helper\zarrinpal;

use Illuminate\Support\Facades\Log;

class SubscribeZarrinpal extends ZarinPalHelper
{

    public function success_go_to_bank($authority, $link , $data)
    {
        // TODO: Implement success_go_to_bank() method.

        echo '<script>window.location.href="' . $link . '"</script>';
    }

    public function fail_to_transaction($data)
    {
        // TODO: Implement fail_to_transaction() method.


    }
}
