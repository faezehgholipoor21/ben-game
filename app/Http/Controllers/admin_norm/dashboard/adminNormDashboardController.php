<?php

namespace App\Http\Controllers\admin_norm\dashboard;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\User;
use App\Rules\national_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminNormDashboardController extends Controller
{
    public function index()
    {


        return view('admin_norm.dashboard.index');
    }

    function profile()
    {
        $admin_norm_info = User::query()
            ->where('id' , auth()->user()->id)
            ->first();
        $genders = Gender::all();

        return view('admin_norm.profile.index', compact('genders','admin_norm_info'));
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $user_id = auth()->user()->id ;

        $validation = Validator::make($input, [
            'mobile' => 'nullable|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'user_image' => "nullable|mimes:png,jpg,jpeg|max:2560", //2.5 MG
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors());
        }

        $user = User::query()
            ->where('id', $user_id)
            ->firstOrFail();

        if ($request->has('user_image')) {
            //get posts image and delete old profile
            $old = $user->user_image;
            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('user_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'user_image_' . time() . '.' . $file_ext;
            $user_image = $file->move('site/assets/user_image', $file_name);

            $user->update([
                'user_image' => RepairFileSrc::repair_file_src($user_image),
            ]);
        }

        $user->update([
            'mobile' => $input['mobile'],
        ]);

        alert()->success('','کاربر با موفقیت ویرایش شد.');
        return back();


    }

}
