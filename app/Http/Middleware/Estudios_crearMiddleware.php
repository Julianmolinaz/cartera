<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Estudios_crearMiddleware
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
            Auth::user()->rol == 'Asesor' ||
            Auth::user()->rol == 'Asesor VIP' ||
            Auth::user()->rol == 'Administrador'  ||
            Auth::user()->rol == 'Call'     
            )
        {
            return $next($request);
        }else{
            return abort(403);
        }
    }
}
