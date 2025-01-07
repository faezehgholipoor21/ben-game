<?php

namespace App\Http\Controllers\site\categories;

use App\Helper\GetAccountFieldTitle;
use App\Helper\GetGameAccountTitle;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DefaultAccount;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class siteCategoryController extends Controller
{
    public function detail($category_id): View
    {
        $cat_info = Category::query()
            ->where('id', $category_id)
            ->first();

        $product_info = Product::query()
            ->where('cat_id', $category_id)
            ->orderBy('created_at', 'asc') // ترتیب صعودی برای قدیمی‌ترین تاریخ
            ->first();

        $accounts = $product_info->accounts;

        $product_images_list = ImageProduct::query()
            ->where('product_id', $category_id)
            ->where('is_main', '!=', 1)
            ->get();

        $keywords = explode(',', $cat_info['cat_meta_keywords']);

        $image_count = \App\Helper\GetProductMainImage::get_product_images($cat_info['id']);

        return view('site.categories.detail', compact('category_id', 'cat_info', 'product_info', 'image_count', 'product_images_list', 'keywords', 'accounts'));
    }

    public function getProducts($cat_id): \Illuminate\Http\JsonResponse
    {
        // دریافت محصولاتی که cat_id آنها برابر مقدار داده‌شده است
        $products = Product::query()
            ->where('cat_id', $cat_id)->get();

        foreach ($products as $product) {
            $product['product_image'] = asset($product['product_image']);
        }
        // بازگشت محصولات به صورت JSON
        return response()->json($products);
    }

    public function get_product_detail(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'id' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'کالای مورد نظر یافت نشد'
            ]);
        }

        $product = Product::query()->find($input['id']);

        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'کالای مورد نظر یافت نشد'
            ]);
        } else {
            $product['product_image'] = asset($product['product_image']);
            $product['product_price'] = @number_format($product['product_price']);
            $product['product_force_price_seperated'] = @number_format($product['product_force_price']);
            return response()->json([
                'error' => false,
                'message' => '',
                'product' => $product
            ]);
        }
    }


    public function get_product_account(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $user_id = Auth::id();

        $default_account = DefaultAccount::query()
            ->where('user_id', $user_id)
            ->get();


        foreach ($default_account as $key => $account) {
            $account['user_account'] = UserAccount::query()
                ->where('user_id', $account->user_id)
                ->where('account_id', $account->account_id)
                ->where('unique_form', $account['unique_form'])
                ->get();

            $account['account_name'] = GetGameAccountTitle::get_game_account_title($account['account_id']);
            foreach ($account['user_account'] as $user) {
                $user['field_title'] = GetAccountFieldTitle::get_account_field_title($user['field_id']);
            }
        };

//        dd($default_account[0]['user_account']);


        if ($default_account->isEmpty()) {
            $default_account = 0;
        }

        $product = Product::query()
            ->with(['accounts.fields'])
            ->find($input['id']);

        $user_account = UserAccount::query()
            ->where('user_id', $input['user_id'])
            ->get();

        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'کالای مورد نظر یافت نشد'
            ]);
        } else {
            return response()->json([
                'error' => false,
                'accounts' => $product['accounts'],
                'user_account' => $user_account,
                'default_account' => $default_account
            ]);
        }
    }
}
