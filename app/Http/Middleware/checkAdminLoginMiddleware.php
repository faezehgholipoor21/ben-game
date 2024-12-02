<?php

namespace App\Http\Middleware;

use App\Models\RoleUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class checkAdminLoginMiddleware
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
        if (!auth()->check()) {
            return $next($request);
        } else {
            $user_info = User::query()
                ->where('id')
                ->first();

            if ($user_info) {
                $role_user_info = RoleUser::query()
                    ->where('user_id', $user_info['id'])
                    ->first();

                if ($role_user_info['role_id'] == 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return $next($request);
                }

            } else {
                return redirect()->route('admin.dashboard');
            }
        }
    }
}
