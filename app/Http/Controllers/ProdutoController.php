<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Produto;
use App\Item;
use App\ProdutoDetalhe;
use App\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //$produtos = Produto::paginate(10);
        //$produtos = Item::paginate(10); //metodo padrão - lazy loading
        $produtos = Item::with(['itemDetalhe', 'fornecedor'])->paginate(10); //metodo agil - eager loading

        /**
         * Forma de trazer o detalhes pro produto, e enviar ao form

        foreach ($produtos as $key => $produto){

            //collection produtoDetalhe
            $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();

            //produtoDetalhe
            if(isset($produtoDetalhe)){
                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
            }
        }
         */

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validacao
        $regras = [
            'nome' => 'required|min:3|max:40', //nomes com minimo 2 maximo 40
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no maximo 40 caracteres',
            'descricao.min' => 'O campo descricao precisa ter no minimo 3 caracteres',
            'descricao.max' => 'O campo descricao precisa ter no maximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um numero inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe'
        ];

        $request->validate($regras, $feedback);

        Item::create($request->all());
        return redirect()->route('produto.index');

        /**
        $produto = new Produto();

        //buscar os valores individualmente
        $nome = $request->get('nome');
        $descricao = $request->get('descricao');

        //tratarop dado
        $nome = strtoupper($nome);

        //atualizar o dados
        $produto->nome = $nome;
        $produto->descricao = $descricao;

        $produto->save();
         * */

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
        return view('app.produto.show', ['produto' => $produto]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {

        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
        //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $produto)
    {
        //$request->all();//payload
        //$produto->getAttributes(); //instancia do objeto no estado anterior

        //validacao
        $regras = [
            'nome' => 'required|min:3|max:40', //nomes com minimo 2 maximo 40
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no maximo 40 caracteres',
            'descricao.min' => 'O campo descricao precisa ter no minimo 3 caracteres',
            'descricao.max' => 'O campo descricao precisa ter no maximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um numero inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe'
        ];

        $request->validate($regras, $feedback);


        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
