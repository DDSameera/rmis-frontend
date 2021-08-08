<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class VerifyToken
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
        $sessionBearerToken = $request->session()->get('bearer_token');

        if (isset($sessionBearerToken)) {
            return $next($request);
        }
        return redirect('login');

    }
}
