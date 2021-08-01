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
                    @endforeach
                    </tbody>
                </table>

                <!-- criando a paginacao usando o metodo links - e usando o metodo appends, após enviar o requeste como arrayu associativo, o appends grava o metodo -->

                <!--
                {{ $fornecedores->count() }} Total de registros por páginas
                <br>
                {{ $fornecedores->total() }} - Total de registros por consulta
                <br>
                {{ $fornecedores->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $fornecedores->lastItem() }} - Número do ultimo registo da página
                -->

                {{ $fornecedores->appends($request)->links() }}
                <br>
                Exibindo {{ $fornecedores->count() }} Fornecedores de {{ $fornecedores->total() }} (de {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }})
            </div>
        </div>
    </div>

@endsection
