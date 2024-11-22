<?php

namespace App\Http\Controllers\admin_norm\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;

class adminNormDashboardController extends Controller
{
    public function index(){
        return view('admin_norm.dashboard.index');
    }

    function profile()
    {
        $genders = Gender::all();

        return view('admin_norm.profile.index', compact('genders'));
    }
}
