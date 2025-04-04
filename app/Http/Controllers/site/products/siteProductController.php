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
use Illuminate\Contracts\View\View;
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
            ->where('id' ,'!=' , 1)
            ->where('parent' ,'!=' , 1)
            ->get();

        $main_categories = Category::query()
            ->where('id', '!=', 1)
            ->where('parent', 1)
            ->get();

        return view('site.products.index', compact('product_list', 'product_cat','main_categories'));
    }

    public function detail($product_id): View
    {
        $product_info = Category::query()
            ->where('id', $product_id)
            ->firstOrFail();

        $image_count = GetProductMainImage::get_product_images($product_info['id']);

        $product_images_list = ImageProduct::query()
            ->where('product_id', $product_id)
            ->where('is_main', '!=', 1)
            ->get();

        $keywords = explode(',', $product_info['product_meta_keywords']);

        return view('site.products.detail', compact('product_info', 'image_count', 'product_images_list', 'keywords'));
    }

}
