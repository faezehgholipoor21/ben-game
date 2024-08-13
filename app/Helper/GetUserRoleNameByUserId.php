<?php

namespace App\Helper;

use App\Models\Role;
use App\Models\RoleUser;

class GetUserRoleNameByUserId
{
    static function get_user_role_name_by_user_id($user_id): array|string
    {
        $user_role_info = [];

        $role_user_info = RoleUser::query()
            ->where('user_id', $user_id)
            ->first();

        $role_info = Role::query()
            ->where('id', $role_user_info['role_id'])
            ->first();

        array_push($user_role_info, $role_info['role_name'], $role_info['role_class']);

        return $user_role_info;
    }
}
