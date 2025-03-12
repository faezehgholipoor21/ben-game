<?php

namespace App\Helper;

use App\Models\MembershipLevel;

class GettingMemeberShipId
{
    static function get_membership_id($membership_name)
    {
        $membership_info = MembershipLevel::query()
            ->where('name', $membership_name)
            ->first();

        return $membership_info['id'];
    }
}
