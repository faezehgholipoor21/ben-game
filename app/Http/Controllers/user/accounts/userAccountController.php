<?php

namespace App\Http\Controllers\user\accounts;

use App\Http\Controllers\Controller;
use App\Models\DefaultAccount;
use App\Models\GameAccount;
use App\Models\UserAccount;
use App\Models\UserAccountDetail;
use App\Models\UserAccountOld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class userAccountController extends Controller
{
    public function index(): View
    {
        $accounts = UserAccount::query()
            ->with(['user_account_details'])
            ->where('user_id', Auth::id())
            ->get();

        return view('user.accounts.index', compact('accounts'));
    }

    public function create(): View
    {
        $game_accounts = GameAccount::query()
            ->with('fields')
            ->get();

        return view('user.accounts.create', compact('game_accounts'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $user_id = Auth::id();

        $validation = Validator::make($input, [
            'game_account' => 'required|integer',
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->messages()->first());
            return back();
        }

        $game_account = GameAccount::query()
            ->with(['fields'])
            ->where('id', $input['game_account'])
            ->firstOrFail();

        foreach ($game_account['fields'] as $field) {
            if (!isset($input['field_' . $field['id']])) {
                alert()->error('', $field->label . ' الزامی است ');
                return back();
            }
        }

        $unique_form = time() . '-' . rand(1000000, 9999999);

        $user_account_info = UserAccount::query()->create([
            'user_id' => $user_id,
            'account_id' => $game_account['id'],
            'unique_form' => $unique_form,
            'default' => 0
        ]);

        foreach ($game_account['fields'] as $field) {
            UserAccountDetail::query()->create([
                'user_account_id' => $user_account_info['id'],
                'field_id' => $field['id'],
                'value' => $input['field_' . $field['id']],
            ]);
        }

        alert()->success('', 'اکانت شما ساخته شد');
        return redirect()->route('user.accounts');
    }

    public function getFields($accountId)
    {
        $fields = DB::table('game_account_field_pivot')
            ->join('game_account_field', 'game_account_field_pivot.account_field_id', '=', 'game_account_field.id')
            ->where('game_account_field_pivot.account_id', $accountId)
            ->select('game_account_field.id', 'game_account_field.label', 'game_account_field.name', 'game_account_field.type')
            ->get();

        return response()->json($fields);
    }

    public function saveAccount(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = auth()->id(); // فرض بر این است که کاربر وارد سیستم شده است
        $uniqueForm = uniqid(); // تولید unique_form

        foreach ($request->fields as $field) {
            DB::table('user_accounts')->insert([
                'user_id' => $userId,
                'account_id' => $request->game_account_id,
                'field_id' => $field['field_id'],
                'unique_form' => $uniqueForm,
                'value' => $field['value']
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function is_default($user_account_id, $unique_form): \Illuminate\Http\RedirectResponse
    {
        $user_account = UserAccount::query()
            ->where('user_id', Auth::id())
            ->where('unique_form', $unique_form)
            ->first();

        if ($user_account['default'] == 0) {
            $user_account->update([
                'default' => 1
            ]);
        } else {
            $user_account->update([
                'default' => 0
            ]);
        }

        alert()->success('', 'اکانت مورد نظر به عنوان پیش فرض در نظر گرفته شد');
        return back();


    }
}
