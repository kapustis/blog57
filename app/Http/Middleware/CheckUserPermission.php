<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $perm
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$perm)
    {
        if (!auth()->user()->hasPermAnyWay($perm)) {
            dd('тебе сюда нельзя');
            abort(404);
        }

        return $next($request);
    }
}
