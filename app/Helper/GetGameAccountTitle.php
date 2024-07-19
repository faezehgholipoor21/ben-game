<?php

namespace App\Helper;

use App\Models\GameAccount;

class GetGameAccountTitle
{
    static function get_game_account_title($game_account_id): array|string
    {
        $game_account_info = GameAccount::query()
            ->where('id' , $game_account_id)
            ->first();

        return $game_account_info['account_name'];
    }
}
