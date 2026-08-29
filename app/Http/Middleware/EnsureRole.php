<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Gates a route group to a single auth guard (customer / organizer / web-admin)
     * and bounces anyone not logged in as that role to the matching login page,
     * enforcing the report's RBAC: each role only reaches its own routes.
     */
    public function handle(Request $request, Closure $next, string $guard, string $loginRoute): Response
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()
                ->route($loginRoute)
                ->with('status', 'Please log in to continue.');
        }

        Auth::shouldUse($guard);

        return $next($request);
    }
}
