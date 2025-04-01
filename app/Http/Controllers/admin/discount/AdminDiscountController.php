<?php

namespace App\Http\Controllers\admin\discount;

use App\Helper\ConvertDateToGregorian;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDiscountController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $discounts = Discount::query()
            ->paginate();

        foreach ($discounts as $discount) {
            $discount['jalali_date'] = verta($discount['expired_time'])->format('%d %B %Y');
        }

        return view('admin.discount.index',compact('discounts'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::query()
            ->where('parent' , '!=' , 0)
            ->where('parent' , '!=' , 1)
            ->get();

        return view('admin.discount.create',compact('categories'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'discount_name' => 'required|string|max:255',
            'discount_code' => 'required|string|max:255',
            'expired_time' => 'required',
            'limit' => 'required',
            'percentage' => 'required',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

            $discount_info = Discount::query()->create([
                'discount_name' => $input['discount_name'],
                'discount_code' => $input['discount_code'],
                'expired_time' => ConvertDateToGregorian::convert_date_to_gregorian($input['expired_time']),
                'limit' => $input['limit'],
                'used' => 0,
                'status' => 1,
//                'status' => DiscountStatus::status_valid,
                'cat_id' => $input['cat'],
                'percentage' => $input['percentage'],
            ]);

        if($discount_info['cat_id'] == 0){
            $products = Product::query()
                ->get();
            foreach ($products as $product) {
                DiscountProduct::query()->create([
                    'product_id' => $product['id'],
                    'discount_id' => $discount_info['id']
                ]);
            }
        }else{
            $products = Product::query()
                ->where('cat_id' , $input['cat'])
                ->get();

            foreach ($products as $product) {
                DiscountProduct::query()->create([
                    'product_id' => $product['id'],
                    'discount_id' => $discount_info['id']
                ]);
            }
        }
            alert()->success('','تخفیف با موفقیت افزوده شد');
            return redirect()->route('admin.discount');
    }

    public function edit($discount_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $discount = Discount::query()->find($discount_id);

        $categories = Category::query()
            ->where('parent' , '!=' , 0)
            ->where('parent' , '!=' , 1)
            ->get();

        $jalali_date = verta($discount['expired_time'])->format('%d %B %Y');


        return view('admin.discount.edit',compact('discount','jalali_date' , 'categories'));

    }

    public function update(Request $request , $discount_id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'discount_name' => 'required|string|max:255',
            'discount_code' => 'required|string|max:255',
            'expired_time' => 'required',
            'limit' => 'required',
            'percentage' => 'required',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $discount_info = Discount::query()->find($discount_id);

        $discount_info->update([
            'discount_name' => $input['discount_name'],
            'discount_code' => $input['discount_code'],
            'expired_time' => ConvertDateToGregorian::convert_date_to_gregorian($input['expired_time']),
            'limit' => $input['limit'],
            'used' => 0,
            'status' => 1,
//                'status' => DiscountStatus::status_valid,
            'cat_id' => $input['cat'],
            'percentage' => $input['percentage'],
        ]);

        if($discount_info['cat_id'] == 0){
            $products = Product::query()
                ->get();
            foreach ($products as $product) {
                DiscountProduct::query()->create([
                    'product_id' => $product['id'],
                    'discount_id' => $discount_info['id']
                ]);
            }
        }else{
            $products = Product::query()
                ->where('cat_id' , $input['cat'])
                ->get();

            foreach ($products as $product) {
                DiscountProduct::query()->create([
                    'product_id' => $product['id'],
                    'discount_id' => $discount_info['id']
                ]);
            }
        }

        alert()->success('','تخفیف با موفقیت ویرایش شد');
        return redirect()->route('admin.discount');

    }

    public function destroy($discount_id): \Illuminate\Http\RedirectResponse
    {
        $discount = Discount::query()->find($discount_id);
        $discount->delete();

        alert()->success('','تخفیف با موفقیت حذف شد');
        return redirect()->route('admin.discount');
    }
}
