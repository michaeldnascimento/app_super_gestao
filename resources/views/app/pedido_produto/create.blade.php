@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Pedido Produto</p>
        </div>
        <div class="menu">
            <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
            <li><a href="">Consulta</a></li>
        </div>
        <div class="informacao-pagina">

            <h4>Detalhe do pedido</h4>

            <table border="1" width="30%" align="center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do produto</th>
                    <th>Data de ilusão do item no pedido</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedido->produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->pivot->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form id="form_{{ $produto->pivot->id }}" method="post" action="{{ route('pedido-produto.destroy', ['pedidoProduto' => $produto->pivot->id, 'pedido_id' => $pedido->id]) }}">
                                @method('DELETE')
                                @csrf
                            <a href="#" onclick="document.getElementById('form_{{ $produto->pivot->id}}').submit()">Excluir</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <p>ID do pedido: {{ $pedido->id }}</p>
            <p>Cliente: {{ $pedido->cliente_id }}</p>

            <div style="width: 30%; margin-left: auto; margin-right: auto;">

                <h4>Itens do pedido</h4>

                @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent

            </div>
        </div>
    </div>

@endsection
