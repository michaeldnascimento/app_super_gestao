<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');

        /**
        $fornecedores = ['Fornecedor 1'];

        return view('app.fornecedor.index', compact('fornecedores'));\
         * */
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::with('produtos')->where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->paginate(5);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores], ['request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {

        $msg = '';

        //inclusão
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $regras = [
                'nome' => 'required|min:3|max:40', //nomes com minimo 2 maximo 40
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
                'nome.max' => 'O campo nome precisa ter no maximo 40 caracteres',
                'uf.min' => 'O campo nome precisa ter no minimo 2 caracteres',
                'uf.max' => 'O campo nome precisa ter no maximo 3 caracteres',
                'email.email' => 'O email informado não é valido'
            ];

            // realizar a validacao dos dados recebidos no request
            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //msg de validacao
            $msg = 'cadastro realizado com sucesso';
        }

        //edição
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Atualização realizado com sucesso';
            }else{
                $msg = 'erro ao atualizar';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }


        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        //consultando o id, e reaproveitando a tela adicionar para editar.
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }


    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}
