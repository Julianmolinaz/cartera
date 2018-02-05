<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ReporteListMiddleware
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
        if( 
            Auth::user()->rol == 'Call VIP' ||
            Auth::user()->rol == 'Administrador'
            )
        {
            return $next($request);
        }else{
            return abort(403);
        }
    }
}
