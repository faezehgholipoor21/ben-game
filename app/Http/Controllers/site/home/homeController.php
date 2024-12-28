<?php

namespace App\Http\Controllers\site\home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Post;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
       $category_mobile = Category::query()
           ->where('parent', 2)
           ->get();

        $slider_info = Slider::query()
            ->where('is_active', 1)
            ->get();

        $banner_info = Banner::query()
            ->where('is_active', 1)
            ->get();

        $categories = Category::query()
            ->where('parent', 1)
            ->get();
        return view('site.home.index', compact('category_mobile' ,'slider_info', 'banner_info' , 'categories'));
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
