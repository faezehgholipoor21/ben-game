<?php

namespace App\Http\Controllers\admin\accounts;

use App\Http\Controllers\Controller;
use App\Models\GameAccount;
use App\Models\GameAccountField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminGameAccountController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $game_account_info = GameAccount::query()
            ->paginate(10);

        return view('admin.account.index', compact('game_account_info'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {

        $game_account_info = GameAccount::query()
            ->get();

        $fields = GameAccountField::query()
            ->orderBy('label')
            ->get();

        return view('admin.account.create', compact('game_account_info', 'fields'));
    }

    public function fields(): \Illuminate\Contracts\View\View
    {
        $game_account_field_info = GameAccountField::query()
            ->paginate(10);
        return view('admin.account.add_field.index',compact('game_account_field_info'));
    }

    public function add_field(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.account.add_field.create');
    }

    public function field_store(Request $request):RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'field_name' => 'required|unique:game_account_field,name',
            'type' => 'required',
            'label' => 'required'
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors())->withInput();
        }

        GameAccountField::query()->create([
            'name' => $input['field_name'],
            'type' => $input['type'],
            'label' => $input['label'],
            'tag' => 'input',
            'priority' => 1,
        ]);
        alert()->success('', 'فیلد با موفقیت افزوده شد.');
        return redirect()->route('admin.game_account_field');
    }

    public function field_delete($id): \Illuminate\Http\RedirectResponse
    {
        $field_account_info = GameAccountField::query()->findOrFail($id);

        $field_account_info->delete();
            alert()->success('', 'فیلد مورد نظر با موفقیت حذف شد.');
            return back();

    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'account_name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors())->withInput();
        }

        $account_info = GameAccount::query()->create([
            'account_name' => $input['account_name'],
        ]);

        $account_info->fields()->attach($input['fields']);

        alert()->success('', 'عنوان اکانت با موفقیت افزوده شد.');
        return redirect()->route('admin.game_account_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\View
    {
        $account_info = GameAccount::query()
            ->findOrFail($id);

        $fields = GameAccountField::query()
            ->orderBy('label')
            ->get();

        return view('admin.account.edit', compact('account_info', 'fields'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $account_info = GameAccount::query()->findOrFail($id);

        $input = $request->all();

        $validation = Validator::make($input, [
            'account_name' => 'required|string|max:255',
            'fields' => 'required|array',
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors())->withInput();
        }

        $account_info->update([
            'account_name' => $input['account_name'],
        ]);

        $account_info->fields()->sync($input['fields']);

        alert()->success('', 'اکانت با موفقیت ویرایش شد.');
        return redirect()->route('admin.game_account_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $account_info = GameAccount::query()->findOrFail($id);

        $game_account_field_count = GameAccountField::query()
            ->where('account_name_id', $id)
            ->count();

        if ($game_account_field_count == 0) {
            $account_info->delete();
            alert()->success('', 'عنوان اکانت با موفقیت حذف شد.');
            return back();
        } else {
            alert()->info('', 'شما برای این اکانت زیرمجموعه تعریف کرده اید لطفا ابتدا آن را حذف نمایید.');
            return back();
        }

    }
}
