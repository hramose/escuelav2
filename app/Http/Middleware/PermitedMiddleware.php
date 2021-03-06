<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\EventlogRegister;

class PermitedMiddleware
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
        $user=$request->user();
        if($user->tipo_usuario_id>=2){
            return $next($request);
        }else{
            $msj='No tiene permisos.';
            $ev=new EventlogRegister;
            $ev->registro(0,$msj,$user->id);
            return response('',404);
        }
    }
}