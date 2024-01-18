<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if ($user && in_array($user->roles, $roles)) {
            return $next($request);
        }

        return redirect()->route('redirect')->with('error', 'Unauthorized. You do not have the required role.');
    }
}
