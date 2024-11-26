<?php

namespace App\Http\Middleware;

use App\Models\RoleUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class userAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user_info = User::query()
                ->where('id', auth()->id())
                ->first();

            if ($user_info) {

                $role_user_info = RoleUser::query()
                    ->where('user_id', $user_info['id'])
                    ->first();

                if ($role_user_info['role_id'] == 2) {
                    return redirect()->route('user.dashboard');
                } elseif ($role_user_info['role_id'] == 3) {
                    return redirect()->route('admin_norm.dashboard');
                } else {
                    auth()->logout();
                    return redirect()->route('user.login');
                }
            }
        } else {
            return redirect()->route('user.login');
        }
    }
}
