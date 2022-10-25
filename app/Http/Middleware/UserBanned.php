<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserBanned
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
        if (auth()->check() && auth()->user()->banned_till != null) {

            if (auth()->user()->banned_till == 0) {
                $message = 'Your account has been banned permanently.';
            }
            if (now()->lessThan(auth()->user()->banned_till)) {
                $banned_days = now()->diffInDays(auth()->user()->banned_till) + 1;
                $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days);
            }

            Auth::logout();
            return redirect()->route('login')->with('status', $message);
        }

        return $next($request);
    }
}
