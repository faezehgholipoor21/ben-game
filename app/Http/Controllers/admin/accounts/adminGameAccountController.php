<?php

namespace App\Http\Controllers\admin\accounts;

use App\Http\Controllers\Controller;
use App\Models\GameAccount;
use App\Models\GameAccountField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminGameAccountController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $game_account_info = GameAccount::query()
            ->paginate(10);

        return view('admin.account.index', compact('game_account_info'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $game_account_info = GameAccount::query()
            ->get();

        return view('admin.account.create',compact('game_account_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'account_name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        GameAccount::create([
            'account_name' => $input['account_name'],
        ]);

        alert()->success('', 'عنوان اکانت با موفقیت افزوده شد.');
        return redirect()->route('admin.game_account_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $account_info = GameAccount::query()->findOrFail($id);
        return view('admin.account.edit', compact('account_info'));
    }

    public function update(Request $request,$id): \Illuminate\Http\RedirectResponse
    {
        $account_info = GameAccount::query()->findOrFail($id);

        $input = $request->all();

        $validation = Validator::make($input, [
            'account_name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $account_info->update([
            'account_name' => $input['account_name'],
        ]);

        alert()->success('', 'اکانت با موفقیت ویرایش شد.');
        return redirect()->route('admin.game_account_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $account_info = GameAccount::query()->findOrFail($id);

        $game_account_field_count = GameAccountField::query()
            ->where('account_name_id' , $id)
            ->count();

        if ($game_account_field_count == 0)
        {
            $account_info->delete();
            alert()->success('', 'عنوان اکانت با موفقیت حذف شد.');
            return back();
        }
        else{
            alert()->info('', 'شما برای این اکانت زیرمجموعه تعریف کرده اید لطفا ابتدا آن را حذف نمایید.');
            return back();
        }

    }
}
