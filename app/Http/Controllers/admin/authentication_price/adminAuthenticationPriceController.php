<?php

namespace App\Http\Controllers\admin\authentication_price;

use App\Http\Controllers\Controller;
use App\Models\AuthenticationPrice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class adminAuthenticationPriceController extends Controller
{
    public function index(): View
    {
        $authentication_prices = AuthenticationPrice::query()->first();

        return view('admin.authentication_price.index', compact('authentication_prices'));
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $price = str_replace(",", "", $input['authentication_price']);

        $authentication_price_info = AuthenticationPrice::query()->first();

        $authentication_price_info->update([
            'authentication_price' => $price
        ]);

        alert()->success('', 'قیمت احراز هویت با موفقیت اعمال شد.');
        return back();
    }
}
