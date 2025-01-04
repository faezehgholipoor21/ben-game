<?php

namespace App\Http\Controllers\user\accounts;

use App\Http\Controllers\Controller;
use App\Models\GameAccount;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class userAccountController extends Controller
{
    public function index(): View
    {
        $accounts = UserAccount::query()
            ->with(['account'])
            ->where('user_id', Auth::id())
            ->groupBy('unique_form')
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
        foreach ($game_account['fields'] as $field) {
            UserAccount::query()->create([
                'user_id' => $user_id,
                'field_id' => $field['id'],
                'account_id' => $game_account['id'],
                'value' => $input['field_' . $field['id']],
                'unique_form' => $unique_form,
            ]);
        }

        alert()->success('', 'اکانت شما ساخته شد');
        return redirect()->route('user.accounts');
    }
}
