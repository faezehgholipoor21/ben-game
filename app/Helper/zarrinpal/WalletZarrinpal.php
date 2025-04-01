<?php

namespace App\Helper\zarrinpal;

use App\Helper\Enums\PaymentStatusEnums;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\Auth;

class WalletZarrinpal extends ZarinPalHelper
{

    public function success_go_to_bank($authority, $link, $amount, $data)
    {
        // TODO: Implement success_go_to_bank() method.

        $user_id = Auth::id();

        $wallet_info = Wallet::query()
            ->where('user_id', $user_id)
            ->first();


        if (!$wallet_info) {
            $wallet_info = Wallet::query()->create([
                'user_id' => $user_id,
                'inventory' => 0,
            ]);
        }


        WalletHistory::query()->create([
            'authority' => $authority,
            'wallet_id' => $wallet_info->id,
            'amount' => $amount,
            'type' => 1,
            'status' => PaymentStatusEnums::status_undefind,
        ]);


        echo '<script>window.location.href="' . $link . '"</script>';
    }

    public function fail_to_transaction($data)
    {
        // TODO: Implement fail_to_transaction() method.

        return redirect()->route('user.wallet');
    }
}
