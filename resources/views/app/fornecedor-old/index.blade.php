<h3>Fornecedor</h3>

{{-- teste comentario --}}
{{-- ' Teste php ' --}}



@php
    // sintases php, caso nescessario para usar no blade
    //echo ' teste php ';
@endphp

{{-- @dd($fornecedores) --}}

@if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h3>Existem fornecedores cadastrados</h3>
@elseif(count($fornecedores) > 10)
    <h3>Existem vários fornecedores cadastrados</h3>
@else
    <h3>Ainda não existem fornecedores cadastrados</h3>
@endif

