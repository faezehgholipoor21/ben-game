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
            try {
                $cartModel = CurrentUserClub::get_detail_cart_club($_COOKIE['cart_id']);

                if ($cartModel->getTotalPrice() === 0 or count($cartModel->getProducts()) === 0) {
                    return redirect()->route('site.cart');
                }

                $main_total_price = $cartModel->getTotalPrice();
                $main_discount = $cartModel->main_discount($_COOKIE['cart_id']);

                $tax_price = ($main_total_price * TaxHelper::get_tax()) / 100;
                $club_percentage = 0;

                $club_percentage = CurrentUserClub::get_percentage_current_user_level_membership();

                $final_price_after_club = $main_total_price + $tax_price;

                return view('site.checkout.index', compact('cartModel', 'main_total_price', 'tax_price', 'main_discount', 'club_percentage', 'final_price_after_club'));

            } catch (\Exception $e) {
                Log::info("cart controller" . $e->getMessage());
            }
        } else {
            return redirect()->route('site.cart');
        }

        return view('site.checkout.index', compact('cartModel', 'main_total_price', 'tax_price', 'main_discount', 'club_percentage', 'final_price_after_club'));
    }
}
