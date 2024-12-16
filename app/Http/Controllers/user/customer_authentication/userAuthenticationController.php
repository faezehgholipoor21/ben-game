<?php

namespace App\Http\Controllers\user\customer_authentication;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBankInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class userAuthenticationController extends Controller
{
    public function index(): View
    {
        $user_info = User::query()
            ->with('status')
            ->where('id', Auth::id())->first();

        $user_bank_info = UserBankInfo::query()
            ->where('user_id', Auth::id())
            ->first();

        return view('user.customer_authentication.index', compact('user_info','user_bank_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $bank_user_info = User::query()
            ->where('id', $input['user_id'])->first();

        $validation = validator::make($input, [
            'national_card_image' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
            'bank_card_image' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
            'account_bank_name' => 'required|string',
            'account_bank_family' => 'required|string',
            'bank_card_number' => 'required|string',
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors());
        }

        $file = $request->file('national_card_image');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'national_card_image_' . time() . '.' . $file_ext;
        $national_card_image = $file->move('site\assets\user_bank_image', $file_name);

        $file_1 = $request->file('bank_card_image');
        $file_ext_1 = $file_1->getClientOriginalExtension();
        $file_name_1 = 'bank_card_image_' . time() . '.' . $file_ext_1;
        $bank_card_image = $file_1->move('site\assets\user_bank_image', $file_name_1);

        UserBankInfo::query()->create([
            'user_id' => $input['user_id'],
            'national_card_image' => RepairFileSrc::repair_file_src($national_card_image),
            'bank_card_image' => RepairFileSrc::repair_file_src($bank_card_image),
            'account_bank_name' => $input['account_bank_name'],
            'account_bank_family' => $input['account_bank_family'],
            'bank_card_number' => $input['bank_card_number'],
        ]);

        $bank_user_info->query()->update([
            'user_status_id' => 1,
        ]);

        alert()->success('', 'اطلاعات شما ثبت گردید ، به محض تایید ادمین سایت ، به شما اعلام میگردد');
        return redirect()->route('user.authentication');

    }
}
