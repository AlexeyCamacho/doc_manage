<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class userBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if ($user = Auth::user()->blocked == 1) {
            Auth::logout();
            abort(403, 'Недостаточно прав.');
        }
        return $next($request);
    }
}
