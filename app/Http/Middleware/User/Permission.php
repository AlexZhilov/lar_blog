<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    public function handle(Request $request, Closure $next, $permission = null)
    {
        if(!auth()->check() && !auth()->user()->hasPermissionTo($permission)){
            abort(404);
        }
        return $next($request);
    }
}
