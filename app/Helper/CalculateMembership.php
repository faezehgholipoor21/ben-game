<?php

namespace App\Helper;

use App\Models\Config;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CalculateMembership
{
    static function calculate_membership(User $user)
    {
        $config_limit_day_membership = Config::query()
            ->where('key' , 'limit_day_membership')
            ->first();

        $order_point_sum = Order::query()
            ->where('user_id' , $user['id'])
            ->where('created_at' , '>=' , Carbon::now()->subDays($config_limit_day_membership['value']))
            ->sum('point_earned');


        //mohasebeye
//        TODO   update user member_level_id


        Log::info('points = ' . $order_point_sum);
    }
}
