@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Clientes</p>
        </div>
        <div class="menu">
            <li><a href="{{ route('cliente.create') }}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </div>
        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <br />
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>

                            <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">Visualizar</a></td>
                            <td>
                                <a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a>
                            </td>
                            <td>
                                <form id="form_{{$cliente->id}}" method="post" action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}">
                                @method('DELETE')
                                @csrf
                                <!-- <button type="submit">Excluir</button> -->
                                    <a href="#" onclick="document.getElementById('form_{{$cliente->id}}').submit()">Excluir</a>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- criando a paginacao usando o metodo links - e usando o metodo appends, após enviar o requeste como arrayu associativo, o appends grava o metodo -->

                {{ $clientes->appends($request)->links() }}

            <!--
                {{ $clientes->count() }} Total de registros por páginas
                <br>
                {{ $clientes->total() }} - Total de registros por consulta
                <br>
                {{ $clientes->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $clientes->lastItem() }} - Número do ultimo registo da página
                -->

                {{ $clientes->appends($request)->links() }}
                <br>
                Exibindo {{ $clientes->count() }} Clientes de {{ $clientes->total() }} (de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }})
            </div>
        </div>
    </div>

@endsection
