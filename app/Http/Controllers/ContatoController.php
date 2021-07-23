<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{

    public function contato(Request $request) //para receber o pos, tem que está tipado como Request
    {



        /**
        echo "<pre>";
        print_r($request->all()); //mostrar array todos
        echo "<pre>";
        print_r($request->input('nome')); //monstrar aparenas a chave selecionada
        echo "<br>";
        print_r($request->input('email'));
         * */

        /** modelo 1 para salvar dados no banco - essa forma é melhor caso deseje fazer um tratamento individual dos inputs
        $contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');

        //print_r($contato->getAttributes());
        $contato->save();
         * */

        /** metodo 2 - salvar contato na forma de array associativo, ele indentifica o fillable no SiteContato   */
        //$contato = new SiteContato();
        //$contato->create($request->all()); // usando o create ele já salve de uma vez, sem precisa do fill e salve
       // $contato->fill($request->all());
       // $contato->save();
        //print_r($contato->getAttributes());


        /**
        $motivo_contatos = [
            '1' => 'Dúvida',
            '2' => 'Elogio',
            '3' => 'Reclamação'
            ];
         * */

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);

    }

    public function Salvar(Request $request)
    {

        $regras = [
                    'nome' => 'required|min:3|max:40|unique:site_contatos', //nomes com minimo 2 maximo 40
                    'telefone' => 'required',
                    'email' => 'email',
                    'motivo_contatos_id' => 'required',
                    'mensagem' => 'required|max:2000'
                 ];

        $feedback = [
                        'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
                        'nome.max' => 'O campo nome precisa ter no maximo 40 caracteres',
                        'nome.unique' => 'O nome informado já está em uso',
                        'email.email' => 'O email informado não é valido',
                        'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',
                        'required' => 'O campo :attribute deve ser preenchido',
                    ];

        // realizar a validacao dos dados recebidos no request
        $request->validate($regras, $feedback);
        /** metodo 2 - salvar contato na forma de array associativo, ele indentifica o fillable no SiteContato   */
        SiteContato::create($request->all()); //usando o create ele já salve de uma vez, sem precisa do fill e salve
        return redirect()->route('site.index');
        //return view('site.contato', ['titulo' => 'Contato']);

    }
}
