<?php

namespace App\Http\Middleware;

use Closure;

class StaffAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            return redirect('/login');
        }

        if (!$request->user()->staff) {
            return abort(403);
        }

        return $next($request);
    }
}
