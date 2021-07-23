<!-- aqui declaramos o nosso layout html no conteudo da view -->
@extends('site.layouts.basico')

<!-- Passando o titulo por parametro string -->
@section('titulo', 'Principal')

<!-- e com o section marcamos aonde vai o conteudo dentro da demarcação html -->
@section('conteudo')


<div class="conteudo-destaque">

    <div class="esquerda">
        <div class="informacoes">
            <h1>Sistema Super Gestão</h1>
            <p>Software para gestão empresarial ideal para sua empresa.<p>
            <div class="chamada">
                <img src="{{ asset('img/check.png') }}">
                <span class="texto-branco">Gestão completa e descomplicada</span>
            </div>
            <div class="chamada">
                <img src="{{ asset('img/check.png') }}">
                <span class="texto-branco">Sua empresa na nuvem</span>
            </div>
        </div>

        <div class="video">
            <img src="{{ asset('img/player_video.jpg') }}">
        </div>
    </div>

    <div class="direita">
        <div class="contato">
            <h1>Contato</h1>
            <p>Caso tenha qualquer dúvida por favor entre em contato com nossa equipe pelo formulário abaixo.<p>
                <!-- trasendo o formulario contato -->
            @component('site.layouts._components.form_contato',  ['classe' => 'borda-branca', 'motivo_contatos' => $motivo_contatos] )
                <!-- caso deseje passar alguma informação contida somente nessa pagina, basta colocar o $slot no form contato -->
                <h3>Teste</h3>
            @endcomponent
        </div>
    </div>
</div>
<!-- finalizando a marcação com endsection -->
@endsection
