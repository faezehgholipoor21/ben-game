<?php

namespace App\Http\Controllers\site\checkout;

use App\Helper\CalculateTotalCart;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;

class siteCheckoutController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if (isset($_COOKIE['cart_id'])) {
            $cart = Cart::query()
                ->where('cookie', $_COOKIE['cart_id'])
                ->get();
        } else {
            $cart = [];
        }

        return view('site.checkout.index' , compact('cart'));
    }


}
