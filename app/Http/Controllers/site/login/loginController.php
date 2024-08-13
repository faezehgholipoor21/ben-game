<?php

namespace App\Http\Controllers\site\login;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
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

        $user_info = User::query()
            ->where('national_code' , $national_code)
            ->first();

        $user_role_info = RoleUser::query()
            ->where('user_id' , $user_info['id'])
            ->first();

        if (auth()->attempt(['national_code' => $national_code, 'password' => $password])) {
                if ($user_role_info['role_id'] == 2){
                    return redirect()->route('user.dashboard');
                }
                elseif($user_role_info['role_id'] == 3){
                    return redirect()->route('admin_norm.dashboard');
                }

        } else {
            alert()->error('','کلمه عبور یا نام کاربری اشتباه است.');
            return back()->withErrors(['auth' => 'کلمه عبور یا نام کاربری اشتباه است.']);
        }
    }


}
