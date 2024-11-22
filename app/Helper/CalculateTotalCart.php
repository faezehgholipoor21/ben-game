<?php

namespace App\Helper;

use App\Models\Cart;

class CalculateTotalCart
{
    static function calculate_total_cart($cookie)
    {
        $cart = Cart::query()
            ->with(['product'])
            ->where('cookie', $cookie)
            ->get();

        $total_price = 0;

        foreach ($cart as $product) {
            $total_price += ($product['product']['product_price']) * $product['count'];
        }

        return $total_price;
    }
}
