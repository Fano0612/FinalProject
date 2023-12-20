<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPassword
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the user has entered the password
        if (!session('entered_password')) {
            return redirect()->route('password.form');
        }

        return $next($request);
    }
}
