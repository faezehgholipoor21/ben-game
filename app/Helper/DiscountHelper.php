<?php

namespace App\Helper;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\DiscountProduct;
use Illuminate\Support\Facades\Log;

class DiscountHelper
{
    static function get_total_price_after_discount($cart_cookie): float|int
    {
        $cart_info = Cart::query()
            ->where('cookie', $cart_cookie)
            ->with('product')
            ->get();

        $discount_all_product = [
            'is_active' => false,
            'percentage' => 0,
        ];
        $list_product_ready_for_discount = [];

        $active_discount = Discount::query()
            ->where('status', 1)
            ->where('cat_id', 0)
            ->latest()
            ->first();

        foreach ($active_discount as $discount) {
            if ($discount['cat_id'] == null) {
                $discount_all_product = [
                    'is_active' => true,
                    'percentage' => $discount['percentage'],
                ];
            } else {
                $discount_product = DiscountProduct::query()
                    ->where('discount_id', $discount['id'])
                    ->pluck('product_id')->toArray();
                foreach ($discount_product as $product) {
                    $list_product_ready_for_discount[] = [
                        'product_id' => $product,
                        'discount_percentage' => $discount['percentage'],
                    ];
                }

            }
        }
        $list_product_ready_for_discount = array_values(array_reduce($list_product_ready_for_discount, function ($carry, $item) {
            $carry[$item['product_id']] = $item;
            return $carry;
        }));

        $object = new DiscountHelper();
        $r = $object->get_discount_for_all_product_cart($discount_all_product['is_active'], $cart_info, $discount_all_product['percentage']);
        $e = $object->get_discount_for_special_product_cart($list_product_ready_for_discount, $cart_info);

        return $e + $r;

    }

    private function get_discount_for_all_product_cart($is_for_all_product_discount, $cart_info, $percentage): float|int
    {
        $total_amount_discount = 0;
        if ($is_for_all_product_discount) {
            foreach ($cart_info as $item) {
                $discount_price = (ChangeDollar::change_dollar(floatval($item['product']['product_price'])) * floatval($percentage)) / 100;
                $total_amount_discount += $discount_price;
            }
        }
        return $total_amount_discount;
    }

    private function get_discount_for_special_product_cart($product_list, $cart_info): float|int
    {
        $total_discount = 0;
        $product_discount_map = [];
        foreach ($product_list as $item) {
            $product_discount_map[$item['product_id']] = $item['discount_percentage'];
        }
        Log::info("product_discount_map: " . json_encode($product_discount_map));

        foreach ($cart_info as $item) {
            $product_id = $item['product_id'];
            $product_price = ChangeDollar::change_dollar($item['product']['product_price']);

            if (isset($product_discount_map[$product_id])) {
                $discount_percentage = $product_discount_map[$product_id];
                $discount_amount = ($product_price * $discount_percentage) / 100;
                $total_discount += $discount_amount;

            }
        }

        return $total_discount;
    }

    static function getProductFinalPrice($cat_id, $price): int|float
    {
        $cat_discount = Discount::query()
            ->where('status', 1)
            ->where('cat_id', $cat_id)
            ->latest()
            ->first();

        if ($cat_discount and $cat_discount['limit'] > $cat_discount['used']) {
            return $price * (100 - $cat_discount['percentage']) / 100;
        }

        $general_discount = Discount::query()
            ->where('status', 1)
            ->latest()
            ->first();

        if ($cat_discount and $general_discount['limit'] > $general_discount['used']) {
            return $price * (100 - $general_discount['percentage']) / 100;
        }

        return $price;
    }
}
