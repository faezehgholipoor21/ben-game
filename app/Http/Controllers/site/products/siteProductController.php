<?php

namespace App\Http\Controllers\site\products;

use App\Helper\CalculateTotalCart;
use App\Helper\GetProductMainImage;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class siteProductController extends Controller
{
    public function index()
    {
        $product_list = Product::query()
            ->paginate();

        $product_cat = Category::query()
            ->get();

        return view('site.products.index', compact('product_list', 'product_cat'));
    }

    public function detail($product_id)
    {
        $product_info = Product::query()
            ->where('id', $product_id)
            ->first();

        $image_count = \App\Helper\GetProductMainImage::get_product_images($product_info['id']);

        $product_images_list = ImageProduct::query()
            ->where('product_id', $product_id)
            ->where('is_main', '!=', 1)
            ->get();

        $keywords = explode(',', $product_info['product_meta_keywords']);

        return view('site.products.detail', compact('product_info', 'image_count', 'product_images_list', 'keywords'));
    }

    public function addToCart(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'product_id' => 'required|string|max:255',
//            'count' => 'required|integer|max:255',
            'cookie' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'خطایی رخ داده است'
            ]);
        }

        $product_info = Product::query()->find($input['product_id']);

        if (!$product_info) {
            return response()->json([
                'error' => true,
                'refresh' => true,
                'message' => 'خطایی رخ داده است'
            ]);
        }

        $cookie = $input['cookie'];

        $exist = Cart::query()
            ->where('cookie', $cookie)
            ->where('product_id', $input['product_id'])
            ->first();

        if ($exist) {

            if ($product_info['inventory'] <= intval($exist['count'])) {
                return response()->json([
                    'error' => true,
                    'refresh' => false,
                    'message' => 'موجودی محصول کافی نیست'
                ]);
            }

            $exist->update([
                'count' => 1 + $exist['count'],
            ]);

        } else {

            Cart::query()->create([
                'product_id' => $input['product_id'],
                'count' => 1,
                'cookie' => $cookie,
            ]);
        }

        $cart_count = Cart::query()
            ->where('cookie', $_COOKIE['cart'])
            ->count();

        return response()->json([
            'error' => false,
            'message' => 'محصول به سبد خرید افزوده شد',
            'cookie' => $cookie,
            'cart_count' => $cart_count,
        ]);

    }

    public function cart()
    {
        if (isset($_COOKIE['cart'])) {
            $cart = Cart::query()
                ->where('cookie', $_COOKIE['cart'])
                ->get();
        } else {
            $cart = [];
        }

        return view('site.cart.index', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'count' => "required | ",
            'cookie' => "required|string|max:255 ",
        ]);

        if ($validation->fails()) {
            if (auth()->check()) {
                auth()->logout();
            }
            return response()->json([
                'error' => true,
                'message' => 'خطایی رخ داده است',
                'refresh' => true,
            ]);
        }

        $cart = Cart::query()
            ->where('cookie', $input['cookie'])
            ->first();

        if (!$cart) {
            if (auth()->check()) {
                auth()->logout();
            }
            return response()->json([
                'error' => true,
                'message' => 'خطایی رخ داده است',
                'refresh' => true,
            ]);
        }

        $cart->update([
            'count' => $input['count']
        ]);

        $total_price = CalculateTotalCart::calculate_total_cart($input['cookie']);

        return response()->json([
            'error' => false,
            'message' => 'سبد خرید به روز رسانی شد',
            'total_price' => @number_format($total_price + ($total_price * 0.1)),
            'pure_total_price' => @number_format($total_price),
            'tax' => @number_format($total_price * 0.1),
        ]);


    }


}
