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

    public function site_login_do(Request $request)
    {
        $input = $request->all();

        $username = $input['username'];
        $password = $input['password'];

        $user_info = User::query()
            ->where('national_code', $username)
            ->first();

        if (!$user_info) {
            alert()->error('', 'کلمه عبور یا نام کاربری اشتباه است.');
            return back()->withErrors(['auth' => 'کلمه عبور یا نام کاربری اشتباه است.']);
        }

        if (password_verify($password, $user_info['password'])) {
                $roles = $user_info->roles;

            foreach ($roles as $role) {
                if ($role['id'] === 2) {
                    auth()->login($user_info);
                    toast()->success('', 'با موفقیت وارد شدید');
                    return redirect()->route('user.dashboard');
                } elseif ($role['id'] === 3) {
                    auth()->login($user_info);
                    toast()->success('', 'با موفقیت وارد شدید');
                    return redirect()->route('admin_norm.dashboard');
                }
            }

            alert()->error('', 'حساب کاربری شما مشکل دارد، لطفا با پشتیبانی تماس بگیرید.');
            return back()->withErrors(['auth' => 'حساب کاربری شما مشکل دارد، لطفا با پشتیبانی تماس بگیرید.']);
        } else {
            alert()->error('', 'کلمه عبور یا نام کاربری اشتباه است.');
            return back()->withErrors(['auth' => 'کلمه عبور یا نام کاربری اشتباه است.']);
        }
    }


}
