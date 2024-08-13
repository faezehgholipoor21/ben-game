<?php

namespace App\Http\Controllers\admin_norm\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminNormDashboardController extends Controller
{
    public function index(){
        return view('admin_norm.dashboard.index');
    }
}
