<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $usuario = Auth::user();
        $cuenta = $usuario->datosUsuario->tipoCuenta->tipo;

        if ($cuenta == 'administrador') {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
