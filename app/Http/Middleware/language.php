<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,Closure $next)
    {

        if(session('language'))
        {
            if(session('language') == 'en')
            {
                App::setlocale('en');
                return $next($request);
            }elseif (session('language') == 'ar')
            {
                App::setLocale('ar');
                return $next($request);
            }
        }else{
            return $next($request);
        }
    }
}
