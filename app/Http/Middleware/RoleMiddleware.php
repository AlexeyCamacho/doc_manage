<?php

namespace App\Http\Middleware;
use Closure;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if(!auth()->user()->hasRole($role)) {
            abort(403, 'Недостаточно прав.');
        }
        if($permission !== null && !auth()->user()->can($permission)) {
            abort(403, 'Недостаточно прав.');
        }
        return $next($request);
    }
}
