<?php

namespace App\Http\Controllers\admin\accounts;

use App\Http\Controllers\Controller;
use App\Models\GameAccountField;
use App\Models\GameAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class adminGameAccountFieldController extends Controller
{

    #[NoReturn] public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $game_account_field_info = GameAccountField::query()
            ->paginate(10);

        foreach ($game_account_field_info as $item) {
            $game_account_info = GameAccount::query()
                ->where('id', $item['account_name_id'])
                ->first();

            $item['account_name_id'] = $game_account_info['account_name'];
        }

        return view('admin.account.account_field.index', compact('game_account_field_info',));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $game_account_field_info = GameAccountField::query()
            ->get();

        $game_account_info = GameAccount::query()
            ->get();

        return view('admin.account.account_field.create', compact('game_account_field_info', 'game_account_info'));
    }

    #[NoReturn] public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'field_title' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $game_account = GameAccount::query()
            ->where('id', $input['account_name_id'])
            ->first();

        GameAccountField::create([
            'field_title' => $input['field_title'],
            'account_name_id' => $game_account['id'],
        ]);

        alert()->success('', 'عنوان فیلد با موفقیت افزوده شد.');
        return redirect()->route('admin.game_account_field_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $account_field_info = GameAccountField::query()->findOrFail($id);

        $account_info = GameAccount::query()->get();

        return view('admin.account.account_field.edit', compact('account_field_info', 'account_info'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $account_field_info = GameAccountField::query()->findOrFail($id);

        $account_info = GameAccount::query()
            ->where('id', $input['account_name_id'])
            ->first();

        $account_field_info->update([
            'field_title' => $input['field_title'],
            'account_name_id' => $account_info['id']
        ]);

        $validation = Validator::make($input, [
            'field_title' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        alert()->success('', 'فیلد اکانت با موفقیت ویرایش شد.');
        return redirect()->route('admin.game_account_field_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $account_field_info = GameAccountField::query()->findOrFail($id);
        $account_field_info->delete();

        alert()->success('', 'فیلد اکانت با موفقیت حذف شد.');
        return back();
    }
}
