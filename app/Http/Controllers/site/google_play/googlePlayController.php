<?php

namespace App\Http\Controllers\site\google_play;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class googlePlayController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('site.google_play.index');
    }
}
