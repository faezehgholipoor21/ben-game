<?php

namespace App\Http\Controllers\site\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class blogSingleController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('site.blog.blog_single');
    }
}
