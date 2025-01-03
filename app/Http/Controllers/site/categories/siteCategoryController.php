<?php

namespace App\Http\Controllers\site\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
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

        $product_images_list = ImageProduct::query()
            ->where('product_id', $category_id)
            ->where('is_main', '!=', 1)
            ->get();

        $keywords = explode(',', $cat_info['cat_meta_keywords']);

        $image_count = \App\Helper\GetProductMainImage::get_product_images($cat_info['id']);

        return view('site.categories.detail', compact('category_id', 'cat_info', 'product_info', 'image_count', 'product_images_list', 'keywords'));
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

        $product = Product::query()->find($input['id']);

        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'کالای مورد نظر یافت نشد2'
            ]);
        } else {
            $accounts = $product->accounts; // حساب‌های مرتبط با محصول
            return response()->json([
                'error' => false,
                'accounts' => $accounts
            ]);
        }
    }
}
