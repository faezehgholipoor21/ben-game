<?php

namespace App\Http\Controllers\site\checkout;

use App\Helper\CalculateTotalCart;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;

class siteCheckoutController extends Controller
{

    public function index()
    {
        if (isset($_COOKIE['cart'])) {
            $cart = Cart::query()
                ->where('cookie', $_COOKIE['cart'])
                ->get();
        } else {
            $cart = [];
        }

        return view('site.checkout.index' , compact('cart'));
    }


}
