<?php

namespace App\Helper;

use App\Models\User;

class GetUsernameWithUserId
{
    static function get_username_with_user_id($user_id)
    {
        $user_info = User::query()
            ->where('id', $user_id)
            ->first();

        $user_name = $user_info['first_name'] .' '. $user_info['last_name'];

        return $user_name;
    }
}
