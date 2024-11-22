<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class loginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user_info = User::query()
                ->where('id', auth()->id())
                ->whereRelation('roles', 'role_id', '=', 2)
                ->first();


            if ($user_info) {
                return $next($request);
            } else {
                auth()->logout();
                return redirect()->route('site_login');
            }
        } else {
            auth()->logout();
            return redirect()->route('site_login');
        }
    }
}
