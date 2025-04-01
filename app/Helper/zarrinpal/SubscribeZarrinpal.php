<?php

namespace App\Helper\zarrinpal;

use Illuminate\Support\Facades\Log;

class SubscribeZarrinpal extends ZarinPalHelper
{

    public function success_go_to_bank($authority, $link, $amount, $data)
    {
        // TODO: Implement success_go_to_bank() method.

        //sakhte subscribe

        // be sun=bscribe history ye authority ezafe kon .

        //sakhte subscribe history = aval vaziatesh bayad na moshakhas bashe

        echo '<script>window.location.href="' . $link . '"</script>';
    }

    public function fail_to_transaction($data)
    {
        // TODO: Implement fail_to_transaction() method.
        return redirect()->route('user.subscribe');

    }
}
