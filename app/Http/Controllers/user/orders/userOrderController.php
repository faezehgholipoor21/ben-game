<?php

namespace App\Http\Controllers\user\orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userOrderController extends Controller
{
    public function index(){
        return view('user.orders.index');
    }

    public function detail(){
        return view('user.orders.order_details');
    }
}
