<?php

namespace App\Http\Controllers\admin\dollar_price;

use App\Http\Controllers\Controller;
use App\Models\DollarPrice;
use Illuminate\Http\Request;

class adminDollarPriceController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dollarPrice = dollarPrice::query()
            ->first();

        return view('admin.dollar_price.index', compact('dollarPrice'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $price = str_replace(",", "", $input['price']);

        $dollarPrice = dollarPrice::query()
            ->where('id', 1)
            ->first();

        $dollarPrice->update([
        'price' => $price
        ]);

        alert()->success('','قیمت جدید با موفقیت ویرایش شد');
        return back();

    }
}
