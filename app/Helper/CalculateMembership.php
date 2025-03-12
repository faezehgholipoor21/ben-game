<?php

namespace App\Helper;

use App\Models\Config;
use App\Models\MembershipLevel;
use App\Models\Order;
use App\Models\Point;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CalculateMembership
{
    static function calculate_membership(User $user)
    {
        $config_limit_day_membership = Config::query()
            ->where('key', 'limit_day_membership')
            ->first();

        $point_sum = Point::query()
            ->where('user_id', $user['id'])
            ->where('created_at', '>=', Carbon::now()->subDays($config_limit_day_membership['value']))
            ->sum('point');

        $membership_level_info = MembershipLevel::query()
            ->orderBy('require_point')
            ->get();

        $membership_result = null;

        foreach ($membership_level_info as $member) {

            if ($point_sum >= $member['require_point']) {

                Log::info('user_id = ' . $user['id'] . ' - ' . 'member_point = ' . $member['require_point'] . '-' . 'point_sum = ' . $point_sum);
                $membership_result = $member['id'];
            }
        }



        if ($membership_result != null) {

            User::query()
                ->where('id', $user['id'])
                ->update([
                    'membership_level_id' => $membership_result,
                ]);
        }
    }
}
