<?php

namespace App\Helper;

use App\Models\Order;
use App\Models\OrderStatus;

class GetOrderStatusTitleCss
{
    static function get_order_status_title_css($order_id)
    {
        $order_info = Order::query()
            ->where('id', $order_id)
            ->first();

        $order_status_info = OrderStatus::query()
            ->where('id', $order_info['order_status'])
            ->first();

        $order_status_data = [];

        array_push($order_status_data, $order_status_info['title'], $order_status_info['order_class']);

        return $order_status_data;
    }
}
