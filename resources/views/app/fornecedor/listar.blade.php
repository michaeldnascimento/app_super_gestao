@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor Lista</p>
        </div>
        <div class="menu">
            <li><a href="{{ route('app.fornecedor.adicionar')}}">Novo</a></li>
            <li><a href="{{ route('app.fornecedor')}}">Consulta</a></li>
        </div>
        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <br />
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Site</th>
                        <th>UF</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fornecedores as $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->nome }}</td>
                        <td>{{ $fornecedor->site }}</td>
                        <td>{{ $fornecedor->uf }}</td>
                        <td>{{ $fornecedor->email }}</td>
                        <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                        <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                    </tr>
                    </tbody>
                    <tr>
                        <td colspan="6">
                            <p>Lista de produtos</p>
                            <table border="1" style="margin: 20px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fornecedor->produtos as $key => $produto)
                                        <tr>
                                            <td>{{ $produto->id }}</td>
                                            <td>{{ $produto->nome }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <!-- criando a paginacao usando o metodo links - e usando o metodo appends, ap??s enviar o requeste como arrayu associativo, o appends grava o metodo -->

                <!--
                {{ $fornecedores->count() }} Total de registros por p??ginas
                <br>
                {{ $fornecedores->total() }} - Total de registros por consulta
                <br>
                {{ $fornecedores->firstItem() }} - N??mero do primeiro registro da p??gina
                <br>
                {{ $fornecedores->lastItem() }} - N??mero do ultimo registo da p??gina
                -->

                {{ $fornecedores->appends($request)->links() }}
                <br>
                Exibindo {{ $fornecedores->count() }} Fornecedores de {{ $fornecedores->total() }} (de {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }})
            </div>
        </div>
    </div>

@endsection
