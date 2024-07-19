<?php

namespace App\Http\Controllers\admin\contact;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminContactSettingController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $setting_contact_info = ContactSetting::query()
            ->first();

        return view('admin.contact.setting_contact.index', compact('setting_contact_info'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $setting_contact_info = ContactSetting::query()
            ->where('id',1)
            ->first();

        $validation = Validator::make($input, [
            'address' => 'required|string',
            'mobile' => 'required|string',
            'email_one' => 'required|string',
            'open_store' => 'required|string',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $setting_contact_info->update([
            'address' => $input['address'],
            'mobile' => $input['mobile'],
            'phone' => $input['phone'],
            'email_one' => $input['email_one'],
            'email_two' => $input['email_two'],
            'open_store' => $input['open_store'],
        ]);

        alert()->success('','تماس با ما با موفقیت ویرایش شد');
        return back();
    }
}
