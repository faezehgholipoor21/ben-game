<?php

namespace App\Http\Controllers\site\checkout;

use App\Helper\CalculateTotalCart;
use App\Helper\CurrentUserClub;
use App\Helper\TaxHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class siteCheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (isset($_COOKIE['cart_id'])) {
            $cartModel = CurrentUserClub::get_detail_cart_club($_COOKIE['cart_id']);
            $products = $cartModel->getProducts();

            $main_total_price = $cartModel->getTotalPrice();

            $tax_price = ($main_total_price * TaxHelper::get_tax()) / 100;

            $final_price_after_club = $main_total_price + $tax_price;

            $club_percentage = CurrentUserClub::get_percentage_current_user_level_membership();

            if ($club_percentage > 0) {
                $final_price_after_club = ceil($final_price_after_club - ($main_total_price * $club_percentage / 100));
            }
        } else {
            $cartModel = null;
            $main_total_price = null;
            $tax_price = null;
            $club_percentage = null;
            $final_price_after_club = null;
            $products = [];
        }

        return view('site.checkout.index', compact('cartModel', 'main_total_price', 'tax_price', 'club_percentage', 'final_price_after_club'));

    }
}
