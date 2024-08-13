<?php

namespace App\Http\Controllers\site\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('site.login.login');
    }

    public function site_login_do(Request $request){
        $input = $request->all();

        $national_code = $input['national_code'];
        $password = $input['password'];

        if (auth()->attempt(['national_code' => $national_code, 'password' => $password])) {
            return redirect()->route('user.dashboard');
        } else {
            alert()->error('','کلمه عبور یا نام کاربری اشتباه است.');
            return back()->withErrors(['auth' => 'کلمه عبور یا نام کاربری اشتباه است.']);
        }
    }


}
