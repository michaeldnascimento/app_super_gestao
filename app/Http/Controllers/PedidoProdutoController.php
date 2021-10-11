<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        //$pedido->produtos; //eager loading
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Pedido $pedido)
    {

        $regras = [
          'produto_id' => 'exists:produtos,id',
          'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'required' => 'O campo :attribute deve possuir um valor válido'
        ];

        $request->validate($regras, $feedback);

        /**
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->quantidade = $request->get('quantidade');
        $pedidoProduto->save();
         * */

        //$pedido->produtos; //os registro do relacionamento pedidos e produtos


        /**
        //USANDO O METODO ATTACH, PARA RELACIONAR O PEDIDOS COM A FUNCÃO PRODUTOS - ISERINDO PEDIDO DE FORMA UNITARIA, PASSANDO O ID DO RELACIONAMENTO
        $pedido->produtos()->attach(
            $request->get('produto_id'),
            [
                'quantidade' => $request->get('quantidade')
            ]
        ); //objeto
         */

        //USANDO O METODO ATTACH, ENCAMINHANDO UM ARRAY ASSOCIATIVO, ENCAMINHANDO OS VALORES DOS CAMPOS QUE DEVE SER ISERIDO NA TABELA AUXILIAR DO RELACIONAMENTO
        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]); //objeto



        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);


//        echo "<pre>";
//        print_r($pedido);
//        echo "<pre>";
//        echo "<hr>";
//        echo "<pre>";
//        print_r($request->all());
//        echo "<pre>";
//        echo "<hr>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int PedidoProduto $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Pedido $pedido, Produto $produto)
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)// usando o pivot
    {
        //
        //print_r($pedido);

        /**
        //convencional
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id
        ])->delete();
        */

        //detach (DELETE PELO RELACIONAMENTO)
        //$pedido->produtos()->detach($produto->id);

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);


    }
}
