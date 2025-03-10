<?php

namespace App\Http\Controllers\site\cart;

use App\Helper\CalculateTotalCart;
use App\Helper\ChangeDollar;
use App\Helper\SetCookie;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class siteCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $input = $request->all();

        $user_acc_radio = $request->input("user_acc_radio");

        $is_force = $request->input("is_force");

        SetCookie::set_cookie();

        $cartCookie = $_COOKIE["cart_id"];


        $productId = $request->input('product_id');

        $validator = Validator::make([
            'cart' => $cartCookie,
            'product_id' => $productId,
        ], [
            'cart' => 'required|string|min:1|max:255',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => '1خطایی رخ داده است'
            ]);
        }

        $product_info = Product::query()->find($input['product_id']);

        if (!$product_info) {

            alert()->success('', 'خطایی رخ داده است');
            return back();
        }

        $cookie = $cartCookie;

//
//        $exist = Cart::query()
//            ->where('cookie', $cookie)
//            ->where('product_id', $input['product_id'])
//            ->first();

//        if ($exist) {
//
//            if ($is_force == 'on') {
//                $exist->update([
//                    'is_force' => 1 ,
//                    'user_account_id' => $user_acc_radio
//                ]);
//            } elseif ($is_force == null) {
//                $exist->update([
//                    'is_force' => 0 ,
//                    'user_account_id' => $user_acc_radio
//                ]);
//            }
//        } else {

        $is_cart = Cart::query()
            ->where('cookie', $cookie)
            ->where('product_id', $input['product_id'])
            ->first();

        if ($is_force == "on") {
            if ($is_cart) {
                $is_cart->update([
                    'count' => $is_cart->count + 1,
                    'is_force' => 1,
                ]);
            }else{
                Cart::query()->create([
                    'product_id' => $productId,
                    'is_force' => 1,
                    'cookie' => $cookie,
                    'count' => 1,
                    'user_account_id' => $user_acc_radio[0]
                ]);
            }

        } else {
            if ($is_cart) {
                $is_cart->update([
                    'count' => $is_cart->count + 1,
                    'is_force' => 0,
                ]);
            }else{
                Cart::query()->create([
                    'product_id' => $productId,
                    'cookie' => $cookie,
                    'count' => 1,
                    'user_account_id' => $user_acc_radio[0],
                    'is_force' => 0
                ]);
            }

        }
        return redirect()->route('site.home')->with('success', 'محصول به سبد خرید افزوده شد');
//
//        alert()->success('', 'محصول به سبد خرید افزوده شد');
//        return redirect()->route('site.home');

//        return response()->json([
//            'error' => false,
//            'message' => 'محصول به سبد خرید افزوده شد',
//            'cookie' => $cookie,
//            'cart_count' => $cart_count,
//        ]);

    }

    public function cart(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if (isset($_COOKIE['cart_id'])) {
            $cart = Cart::query()
                ->where('cookie', $_COOKIE['cart_id'])
                ->get();

        } else {
            $cart = [];
        }

        return view('site.cart.index', compact('cart'));
    }

    public function updateCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'count' => "required | ",
            'cookie' => "required|string|max:255 ",
        ]);

        if ($validation->fails()) {
            if (auth()->check()) {
                auth()->logout();
            }
            return response()->json([
                'error' => true,
                'message' => 'خطایی رخ داده است',
                'refresh' => true,
            ]);
        }

        $cart = Cart::query()
            ->where('cookie', $input['cookie'])
            ->where('product_id', $input['product_id'])
            ->first();

        if (!$cart) {
            if (auth()->check()) {
                auth()->logout();
            }

            return response()->json([
                'error' => true,
                'message' => 'خطایی رخ داده است',
                'refresh' => true,
            ]);
        } else {
            $cart->update([
                'count' => $input['count']
            ]);
            $total_price = CalculateTotalCart::calculate_total_cart($input['cookie']);

            $change_total_price = ChangeDollar::change_dollar($total_price);

            return response()->json([
                'error' => false,
                'message' => 'سبد خرید به روز رسانی شد',
                'total_price' => @number_format($change_total_price + ($change_total_price) * 0.1),
                'pure_total_price' => @number_format($change_total_price),
                'tax' => @number_format($change_total_price * 0.1),
            ]);
        }
    }
}
