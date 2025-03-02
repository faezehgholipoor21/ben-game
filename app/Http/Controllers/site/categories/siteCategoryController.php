<?php

namespace App\Http\Controllers\site\categories;

use App\Helper\ChangeDollar;
use App\Helper\GetAccountFieldTitle;
use App\Helper\GetGameAccountTitle;
use App\Helper\GetProductMainImage;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DefaultAccount;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\UserAccount;
use App\Models\UserAccountOld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class siteCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->where('id', '!=', 1)
            ->get();

        $main_categories = Category::query()
            ->where('id', '!=', 1)
            ->where('parent', 1)
            ->get();

        return view('site.categories.index', compact('categories', 'main_categories'));
    }

    public function cat_index($cate_id)
    {
        $cat_info = Category::query()
            ->where('id', $cate_id)
            ->first();

        $cat_title = $cat_info['cat_title'];

        $categories = Category::query()
            ->where('parent', $cate_id)
            ->get();

        $main_categories = Category::query()
            ->where('id', '!=', 1)
            ->where('parent', 1)
            ->get();

        return view('site.categories.cat_index', compact('categories', 'main_categories', 'cat_title'));
    }

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

        $image_count = GetProductMainImage::get_product_images($cat_info['id']);

        return view('site.categories.detail', compact('category_id', 'cat_info', 'product_info', 'image_count', 'product_images_list', 'keywords', 'accounts'));
    }

    public function getProducts($cat_id): \Illuminate\Http\JsonResponse
    {
        // دریافت محصولاتی که cat_id آنها برابر مقدار داده‌شده است
        $products = Product::query()
            ->where('cat_id', $cat_id)->get();

        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_image' => asset($product->product_image),
                'product_price' => number_format(ChangeDollar::change_dollar($product->product_price)),
                'product_force_price' => number_format(ChangeDollar::change_dollar($product->product_force_price)),
            ];
        });

//        foreach ($products as $product) {
//            Log::info('product_price=' . ChangeDollar::change_dollar($product['product_price']));
//
//            $product['product_image'] = asset($product['product_image']);
//            $product['product_price'] = number_format(ChangeDollar::change_dollar($product['product_price']),2);
//            $product['product_force_price'] = number_format(ChangeDollar::change_dollar($product['product_force_price']),2);
//        }

        // بازگشت محصولات به صورت JSON
        return response()->json($formattedProducts);
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
//            $product['product_image'] = asset($product['product_image']);
//            $product['product_price'] = @number_format(ChangeDollar::change_dollar($product['product_price']));
//            $product['product_force_price_seperated'] = @number_format(ChangeDollar::change_dollar($product['product_force_price']));



            $formattedProduct = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '',
                'product_image' => asset($product->product_image),
                'product_price' => isset($product->product_price)
                    ? number_format(floatval(ChangeDollar::change_dollar($product->product_price)), 2)
                    : '0.00',

                'product_force_price_seperated' => isset($product->product_force_price) ? number_format(ChangeDollar::change_dollar($product->product_force_price), 2) : '0.00',
            ];


            return response()->json([
                'error' => false,
                'message' => '',
                'product' => $formattedProduct
            ]);
        }
    }


    public function get_product_account(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $user_id = Auth::id();

        if ($user_id) {
            $user_accounts = UserAccount::query()
                ->with('account')
                ->with('user_account_details.fieldInfo')
                ->where('user_id', $user_id)
                ->orderBy('default', 'desc')
                ->get();

            if ($user_accounts->isEmpty()) {
                $default_account = 0;
            }

            $product = Product::query()
                ->select(['id', 'product_name'])
                ->with(['accounts.fields'])
                ->find($input['id']);


            if (!$product) {
                return response()->json([
                    'error' => true,
                    'message' => 'کالای مورد نظر یافت نشد'
                ]);
            } else {
                return response()->json([
                    'error' => false,
                    'user_accounts' => $user_accounts
                ]);
            }

        } else if ($user_id == null) {
            return response()->json([
                'error' => true,
                'message' => 'کاربری یافت نشد'
            ]);
        }

        return response()->json([]);

    }



}
