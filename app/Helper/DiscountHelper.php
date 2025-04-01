<?php

namespace App\Helper;

use App\Models\Cart;
use App\Models\Discount;
use mysql_xdevapi\Exception;

class DiscountHelper
{
    static function get_total_price_after_discount($cart_cookie)
    {

        $discount_info = Discount::query()
            ->where('discount_code', $discount_code)
            ->first();
//
//        $cart_info = Cart::query()
//            ->where('cookie', $cart_cookie)
//            ->first();

//        if ($discount_info) {
//            $total_discount = ($total_price * $discount_info->percentage) / 100;
//            return $total_price - $total_discount;
//        } else {
//            throw new \Exception('کد تخفیف نامعتبر است');
//        }
    }
}
