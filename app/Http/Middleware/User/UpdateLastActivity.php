<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            auth()->user()->updateLastActivity();
        }

        return $next($request);
    }
}
