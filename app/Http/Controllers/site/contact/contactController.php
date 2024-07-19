<?php

namespace App\Http\Controllers\site\contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactSetting;
use App\Models\SettingContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class contactController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $setting_contact_info = ContactSetting::query()
            ->first();

        return view('site.contact.index', compact('setting_contact_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'contact_name' => 'required|string|max:255',
            'contact_mobile' => 'required|string|max:255',
            'contact_subject' => 'required|string|max:255',
            'contact_content' => 'required|string|max:50000',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        Contact::query()->create([
            'contact_name' => $input['contact_name'],
            'contact_mobile' => $input['contact_mobile'],
            'contact_subject' => $input['contact_subject'],
            'contact_content' => $input['contact_content'],
        ]);

        alert()->success('', 'سوال با موفقیت ثبت شد', 'و کاربران ما با شما ارتباط برفرار میکنند');
        return redirect()->route('site.contact');

    }
}



