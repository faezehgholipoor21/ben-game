<?php

namespace App\Http\Controllers\site\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class forgotPasswordController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('site.login.forgot-password');
    }
}
