<?php

namespace App\Http\Controllers\site\foreign_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class foreignPaymentController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('site.foreign_payment.index');
    }
}
