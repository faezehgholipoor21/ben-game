<?php

namespace App\Helper;

use App\Models\GameAccount;
use App\Models\UserAccount;
use App\Models\UserAccountDetail;

class GetUserAccountTitle
{
    static function get_user_account_title($user_account_id)
    {
        $user_account_info = UserAccount::query()
            ->where('account_id', $user_account_id)
            ->first();

        $game_account_info = GameAccount::query()
            ->where('id', $user_account_info->account_id)
            ->first();

        return $game_account_info->account_name;
    }
}
