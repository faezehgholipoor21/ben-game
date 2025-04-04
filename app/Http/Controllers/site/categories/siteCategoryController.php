<?php

namespace App\Http\Controllers\site\categories;

use App\Helper\ChangeDollar;
use App\Helper\DiscountHelper;
use App\Helper\GetAccountFieldTitle;
use App\Helper\GetGameAccountTitle;
use App\Helper\GetProductMainImage;
use App\Helper\GetSellerName;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DefaultAccount;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\UserAccount;
use App\Models\UserAccountOld;
use Illuminate\Http\JsonResponse;
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

    public function detail($category_id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $cat_info = Category::query()
            ->where('id', $category_id)
            ->first();

        $product_info = Product::query()
            ->where('cat_id', $category_id)
            ->orderBy('created_at')
            ->first();

        if ($product_info) {
            $accounts = $product_info->accounts;

            $product_info['final_price'] = DiscountHelper::getProductFinalPrice($product_info['cat_id'], $product_info['product_price']);

            $product_images_list = ImageProduct::query()
                ->where('product_id', $category_id)
                ->where('is_main', '!=', 1)
                ->get();

            $keywords = explode(',', $cat_info['cat_meta_keywords']);

            $image_count = GetProductMainImage::get_product_images($cat_info['id']);

            return view('site.categories.detail', compact('category_id', 'cat_info', 'product_info', 'image_count', 'product_images_list', 'keywords', 'accounts'));
        } else {
            alert()->success('', 'برای این دسته هنوز محصولی تعریف نشده است');
            return redirect()->route('site.home');
        }
    }

    public function getProducts($cat_id): JsonResponse
    {
        // دریافت محصولاتی که cat_id آنها برابر مقدار داده‌شده است
        $products = Product::query()
            ->where('cat_id', $cat_id)
            ->get();

        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_image' => asset($product->product_image),
                'product_price' => number_format(ChangeDollar::change_dollar($product->product_price)),
                'final_price' => number_format(ChangeDollar::change_dollar(DiscountHelper::getProductFinalPrice($product['cat_id'], $product->product_price))),
                'product_force_price' => number_format(ChangeDollar::change_dollar($product->product_force_price)),
                'seller_product_name' => GetSellerName::get_seller_name($product->user_seller_id),
            ];
        });

        // بازگشت محصولات به صورت JSON
        return response()->json($formattedProducts);
    }

    public function get_product_detail(Request $request): JsonResponse
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

            $formattedProduct = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '',
                'product_image' => asset($product->product_image),
                'product_price' => isset($product->product_price) ? number_format(floatval(ChangeDollar::change_dollar($product->product_price))) : 0,
                'final_price' => number_format(ChangeDollar::change_dollar(DiscountHelper::getProductFinalPrice($product['cat_id'], $product->product_price))),

                'product_force_price_seperated' => isset($product->product_force_price) ? number_format(ChangeDollar::change_dollar($product->product_force_price), 2) : '0.00',
            ];

            return response()->json([
                'error' => false,
                'message' => '',
                'product' => $formattedProduct
            ]);
        }
    }


    public function get_product_account(Request $request): JsonResponse
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
