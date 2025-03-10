<?php

namespace App\Helper;

use App\Models\Config;
use App\Models\Order;

class PointHelper
{
    static function convert_order_too_point($order_id)
    {
        $order_info = Order::find($order_id);

        $config_point_info = Config::query()->where('key', 'point_dollar')->first();

        $point = ($order_info['total_price_usd'] * $config_point_info['value']);

        return $point;
    }

    static function convert_order_too_point_with_total_price_usd($total_price_usd)
    {
        $config_point_info = Config::query()->where('key', 'point_dollar')->first();

        $point = ($total_price_usd * $config_point_info['value']);

        return $point;
    }
}
