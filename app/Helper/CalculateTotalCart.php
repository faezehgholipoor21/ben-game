<?php

namespace App\Helper;

use App\Models\Cart;

class CalculateTotalCart
{
    static function calculate_total_cart($cookie): float|int
    {
        $cart = Cart::query()
            ->with(['product'])
            ->where('cookie', $cookie)
            ->get();

        $total_price = 0;


        foreach ($cart as $cart_item) {
            if ($cart_item['is_force'] == 0) {
                $total_price += ($cart_item['product']['product_price']) * $cart_item['count'];
            } else {
                $total_price += ($cart_item['product']['product_force_price']) * $cart_item['count'];
            }
        }

        return $total_price;
    }
}
