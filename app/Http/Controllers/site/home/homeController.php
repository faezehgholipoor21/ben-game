<?php

namespace App\Http\Controllers\site\home;

use App\Http\Controllers\Controller;
use App\Models\ImageProduct;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product_info = Product::query()
            ->get();

        foreach ($product_info as $product){
            $image_product_info = ImageProduct::query()
                ->where('product_id' , $product['id'])
                ->where('is_main' , 1)
                ->where('image_id' , 5)
                ->first();

            $product['image_product'] = $image_product_info['image_src'];

        }

        return view('site.home.index',compact('product_info'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('post_title', 'LIKE', "%{$query}%")
            ->orWhere('post_content', 'LIKE', "%{$query}%")
            ->get();

        return view('site.search.index', compact('posts'));
    }
}
