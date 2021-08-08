<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDeniedException;
use Closure;
use Illuminate\Http\Request;


class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userRole = $request->session()->get('user_role');

        if ($userRole === "admin") {
            return $next($request);
        }
        throw new PermissionDeniedException();
    }
}
