<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;

class autoCheckPermission
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
        $route = $request->route()->getName();
        $permission = Permission::whereRaw("FIND_IN_SET('$route',routes)")->first();

        if($permission)
        {
            if(!auth()->user()->can($permission->name))
            {
                abort(403);
            }
        }
        return $next($request);
    }
}
