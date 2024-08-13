<?php

namespace App\Http\Controllers\user\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index');
    }
}
