<?php

namespace App\Http\Controllers\site\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageProduct;
use Illuminate\Http\Request;
use Illuminate\View\View;

class siteCategoryController extends Controller
{
    public function detail($category_id): View
    {
        $cat_info = Category::query()
            ->where('id', $category_id)
            ->first();

        $product_images_list = ImageProduct::query()
            ->where('product_id', $category_id)
            ->where('is_main', '!=', 1)
            ->get();

        $keywords = explode(',', $cat_info['cat_meta_keywords']);


        $image_count = \App\Helper\GetProductMainImage::get_product_images($cat_info['id']);

        return view('site.categories.detail', compact('category_id', 'cat_info', 'image_count', 'product_images_list', 'keywords'));
    }
}
