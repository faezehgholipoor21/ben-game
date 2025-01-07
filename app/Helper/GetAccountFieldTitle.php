<?php

namespace App\Helper;

use App\Models\GameAccountField;

class GetAccountFieldTitle
{
    static function get_account_field_title($field_id)
    {
        $game_account_field_info = GameAccountField::query()
            ->where('id', $field_id)
            ->first();

        return $game_account_field_info->label;
    }

}
