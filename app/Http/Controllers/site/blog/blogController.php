<?php

namespace App\Http\Controllers\site\blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class blogController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::query()
            ->paginate(5);
        return view('site.blog.index',compact('posts'));
    }
}
