@extends('app.layouts.basico')

@section('titulo', 'Pedido')

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Pedido</p>
        </div>
        <div class="menu">
            <li><a href="{{ route('pedido.create') }}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </div>
        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <br />
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cliente</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente_id }}</td>
                            <td><a href="{{ route('pedido-produto.create', ['pedido' => $pedido->id ]) }}">Adicionar Produto</a></td>

                            <td><a href="{{ route('pedido.show', ['pedido' => $pedido->id]) }}">Visualizar</a></td>
                            <td>
                                <a href="{{ route('pedido.edit', ['pedido' => $pedido->id]) }}">Editar</a>
                            </td>
                            <td>
                                <form id="form_{{$pedido->id}}" method="post" action="{{ route('pedido.destroy', ['pedido' => $pedido->id]) }}">
                                @method('DELETE')
                                @csrf
                                <!-- <button type="submit">Excluir</button> -->
                                    <a href="#" onclick="document.getElementById('form_{{$pedido->id}}').submit()">Excluir</a>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- criando a paginacao usando o metodo links - e usando o metodo appends, após enviar o requeste como arrayu associativo, o appends grava o metodo -->

                {{ $pedidos->appends($request)->links() }}

            <!--
                {{ $pedidos->count() }} Total de registros por páginas
                <br>
                {{ $pedidos->total() }} - Total de registros por consulta
                <br>
                {{ $pedidos->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $pedidos->lastItem() }} - Número do ultimo registo da página
                -->

                {{ $pedidos->appends($request)->links() }}
                <br>
                Exibindo {{ $pedidos->count() }} Pedidos de {{ $pedidos->total() }} (de {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }})
            </div>
        </div>
    </div>

@endsection
