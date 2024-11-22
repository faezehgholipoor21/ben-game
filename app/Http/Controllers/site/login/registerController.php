<?php

namespace App\Http\Controllers\site\login;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use App\Rules\national_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class registerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('site.login.register');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'national_code' => ['required', new national_code],
            'email' => 'required|string|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), '');
            return back()->withErrors($validation->errors())->withInput();
        }

        $user_info = User::query()->create([
            'first_name' => $input['name'],
            'last_name' => $input['family'],
            'mobile' => $input['mobile'],
            'national_code' => $input['national_code'],
            'email' => $input['email'],
            'user_image' => 'site/assets/img/user_placeholder.png' ,
            'password' => password_hash($input['mobile'], PASSWORD_DEFAULT),
            'is_active' => 0,
        ]);

        RoleUser::query()->create([
            'role_id' => 2,
            'user_id' => $user_info['id']
        ]);

        auth()->login($user_info);

        alert()->success('', 'ثبت نام شما با موفقیت انجام شد');
        return redirect()->route('site.home');
    }
}

