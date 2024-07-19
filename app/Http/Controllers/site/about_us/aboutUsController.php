<?php

namespace App\Http\Controllers\site\about_us;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class aboutUsController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $about_info = AboutUs::query()
            ->first();

        return view('site.about_us.index',compact('about_info'));
    }
}
