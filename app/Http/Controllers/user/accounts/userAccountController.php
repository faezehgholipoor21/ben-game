<?php

namespace App\Http\Controllers\user\accounts;

use App\Http\Controllers\Controller;
use App\Models\GameAccount;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class userAccountController extends Controller
{
    public function index(): View
    {
        $accounts = UserAccount::query()
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
}
