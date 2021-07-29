<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Response;
use Illuminate\Contracts\Support\Responsable;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao, $perfil)
    {

        session_start();

        if (isset($_SESSION['email']) && $_SESSION['email'] != ''){
            //envia para o proximo middleware
            return $next($request);
        }else{
            return redirect()->route('site.login', ['erro' => 2]);
        }

        /**
        echo $metodo_autenticacao. '<br>' .$perfil.'<br>';
        //verifica se o usuariop possui acesso a rota

        //verifica se o usuariop possui acesso a rota
        if($metodo_autenticacao == 'padrao'){
            echo 'Vericicar o usuario e senha no banco de dados'. '<br>';
        }

        if ($metodo_autenticacao == 'ldap'){
            echo 'Verifica o usuario e senha no AD'. '<br>';
        }

        if($perfil == 'visitante'){
            echo 'exibir alguns recursos'. '<br>';
        }else{
            echo 'apresentar dados do banco de dadops';
        }

        if ($metodo_autenticacao == 'ldap'){
            echo 'Verifica o usuario e senha no AD'. '<br>';
        }

        if(true){
         * //envia para o proximo middleware
            return $next($request);
        }else{
            return Response('Acesso negado! Rota exige autenticação!!!');
        }
         * */

    }
}
