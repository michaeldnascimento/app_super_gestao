<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Response;
use App\LogAcesso;

class LogAcessoMiddleware
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
        //$request - manipular
        //return $next($request);
        //response - manipular
        //dd($request);

        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log' => "IP $ip requisitou a rota $rota"]);
        //return Response('Chegamos no middleware e finalisamos no probrio.');
        //return $next($request);

        $resposta =  $next($request);
        $resposta->setStatusCode(201, 'O status da resposta e o texte foram modificados!!');
        return $resposta;
        //dd($resposta);

    }
}
