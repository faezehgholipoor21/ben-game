<?php

namespace App\Helper;

use App\Models\User;

class GetSellerName
{
    static function get_seller_name($user_seller_id): string
    {
        if ($user_seller_id == null) {
            return 'ادمین سایت';
        }
        else{
            $user_info = User::query()->where('id', $user_seller_id)->first();
            return $user_info->first_name . ' ' . $user_info->last_name;
        }

    }
}
