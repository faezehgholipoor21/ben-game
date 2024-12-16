<?php

namespace App\Helper;

use App\Models\OrderDetail;

class GetOrderDetailCount
{
    static function get_order_detail_count($order_id): int
    {
        return OrderDetail::query()
            ->where('order_id', $order_id)
            ->count();
    }
}
