<?php

namespace App\Helper;

use App\Models\OrderDetail;

class CalculateOrderPrice
{
    static function calculate_order_price($order_id)
    {
        $order_detail_info = OrderDetail::query()
            ->where('order_id' , $order_id)
            ->get();

        $total_price = 0 ;

        foreach ($order_detail_info as $order){
            $total_price += intval($order['bought_price']) ;
        }

        return $total_price;
    }
}
