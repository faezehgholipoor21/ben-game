<?php

namespace App\Helper;

use App\Models\DefaultAccount;

class GetActiveAccount
{
    static function get_active_account($unique_form): int
    {
        $default_account = DefaultAccount::query()
            ->where('unique_form', $unique_form)
            ->first();

        if ($default_account) {
            return 1;
        } else {
            return 0;
        }
    }
}
