<?php

namespace App\Helper;

use App\Models\OrderStatus;

class GetOrderStatusTitle
{
    static function get_order_status_title($order_status_id)
    {
        $order_status_info = OrderStatus::query()
            ->where('id', $order_status_id)
            ->first();

        return $order_status_info['title'];
    }
}
