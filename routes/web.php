<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
Route::get('/', function () {
    return 'Olá Mundo';
});

Route::get('sobre-nos', function () {
return 'Sobre Nós';
});

Route::get('contato', function () {
return 'Contato';
});

 */

// os middleware pode ser adicioonado aqui em rotas invividualmente, ou se nescessario adicionar todas as rotas web de uma vez só, vai no arquivo kernel

Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/contato', 'ContatoController@Contato')->name('site.contato');
Route::get('/sobre-nos', 'SobreNosController@SobreNos')->name('site.sobrenos');
Route::post('/contato', 'ContatoController@Salvar')->name('site.contato');

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

/** agrupando rotas */
Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function() //caso deseje acessar mais de um middleware middleware('log.acesso', 'autenticacao')
{
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');
    Route::get('/cliente', 'ClienteController@index')->name('app.cliente');
    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::get('/produto', 'ProdutoController@index')->name('app.produto');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

/** caso a rota não seja encontrada, ultilizamos o fallback */
Route::fallback(function (){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Cliquei aqui</a> para voltar.';
});

/**
Route::get('/rota1', function() {
    echo 'Rota 1';
})->name('site.rota1');

redirecionar rotas
Route::get('/rota2', function() {
    return redirect()->route('site.rota1');
})->name('site.rota2');

redirecionar rotas, exemplo 2
Route::redirect('/rota2', '/rota1');
*/


/** rota de callback
Route::get('/contato/{nome}/{categoria}/{assunto}/{msg?}',

    function(string $nome, string $categoria, string $assunto, string $msg = 'Msg não informada.')
    {
    echo "Estamos aqui:  $nome - $categoria - $assunto - $msg";
    }
);

Route::get('/contato/{nome}/{categoria_id}',

    function(
        string $nome = "Desconhecido",
        int $categoria_id = 1 // 1 - Informação
        )
    {
        echo "Estamos aqui:  $nome - $categoria_id";
    }
)->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+');
*/
