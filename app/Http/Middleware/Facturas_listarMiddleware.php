<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Facturas_listarMiddleware
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
            Auth::user()->rol == 'Call' ||
            Auth::user()->rol == 'Cartera' ||
            Auth::user()->rol == 'Recaudador' ||
            Auth::user()->rol == 'Asesor'     ||
            Auth::user()->rol == 'Asesor VIP' ||
            Auth::user()->rol == 'Administrador'
            )
        {
            return $next($request);
        }else{
            return abort(403);
        }
    }
}
