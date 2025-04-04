<?php

namespace App\Helper;

use App\Models\Cart;
use App\Models\CartModel;
use App\Models\MembershipLevel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CurrentUserClub
{
    /**
     * @throws \Exception
     */
    static function get_detail_cart_club($cookie)
    {
        $user_level = self::get_level_membership();
        $percentage = null;
        $cart_model = new CartModel();

        if ($user_level) {
            $percentage = self::get_percentage_level_membership($user_level);
            $cart_model->setPercentage($percentage);
        }

        $cart_info = Cart::query()
            ->where('cookie', $cookie)
            ->get();

        foreach ($cart_info as $cart) {
            $product_info = Product::query()
                ->where('id', $cart->product_id)
                ->first();

            if ($cart->is_force) {
                $price = ChangeDollar::change_dollar(DiscountHelper::getProductFinalPrice($product_info->cat_id, $product_info->product_force_price));
            } else {
                $price = ChangeDollar::change_dollar(DiscountHelper::getProductFinalPrice($product_info->cat_id, $product_info->product_price));
            }

            $cart_model->addProduct([
                'id' => $product_info->id,
                'name' => $product_info->product_name,
                'price' => ChangeDollar::change_dollar($product_info->product_price),
                'quantity' => $cart->count,
                'force_price' => ChangeDollar::change_dollar($product_info->product_force_price),
                'main_price' => $price,
                'is_force' => $cart->is_force,
                'percentage' => $percentage,
                'inventory' => $product_info->inventory,
                'final_price' => $price * $cart->count,
                'cat_id' => $product_info->cat_id,
            ]);
        }

        return $cart_model;
    }

    static function get_level_membership()
    {
        $user = Auth::user();
        return $user['membership_level_id'];

    }

    static function get_percentage_level_membership($memebership_level_id)
    {
        $membership_info = MembershipLevel::query()
            ->where('id', $memebership_level_id)
            ->first();

        return $membership_info->discount ?? 0;
    }

    static function get_percentage_current_user_level_membership(): int
    {
        $user = Auth::user();

        $membership_level_id = $user['membership_level_id'];

        $membership_info = MembershipLevel::query()
            ->where('id', $membership_level_id)
            ->first();

        return !$membership_info ? 0 : intval($membership_info->discount);
    }
}
