<?php

namespace App\Helper;



class SetCookie
{
    public static function set_cookie()
    {
        if (!isset($_COOKIE['cart_id'])) {
            $cart_id = uniqid("cart_", true);

            setcookie('cart_id', $cart_id, time() + (60 * 60 * 24 * 7), "/");

            $_COOKIE['cart_id'] = $cart_id;

            return $cart_id;
        } else {
            return $_COOKIE['cart_id'];
        }
    }

    public static function delete_cookie()
    {
        setcookie('cart_id', '', time() - 3600, "/");

        unset($_COOKIE['cart_id']);
    }
}

//
//// اگر کوکی cart_id قبلاً وجود نداشت، یک مقدار یونیک ایجاد کن
//if (!isset($_COOKIE["cart_id"])) {
//    $cart_id = uniqid("cart_", true); // مقدار یونیک
//    setcookie("cart_id", $cart_id, time() + (7 * 24 * 60 * 60), "/"); // تنظیم کوکی برای 7 روز
//
//    // نمایش مقدار جدید (چون در $_COOKIE فعلاً قابل مشاهده نیست)
//    echo "سبد خرید شما ایجاد شد. شناسه: " . $cart_id;
//} else {
//    // اگر کوکی از قبل موجود باشد، مقدار آن را نمایش بده
//    echo "سبد خرید شما از قبل موجود است. شناسه: " . $_COOKIE["cart_id"];
//
//}
//
//$cart__ = $_COOKIE["cart_id"];
//
//return $cart__;
