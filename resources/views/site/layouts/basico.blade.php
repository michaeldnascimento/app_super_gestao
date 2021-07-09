<!-- Aqui colocamos o html e css que vão conter em todas as nossas views, forma de encapsular o codigo -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Super Gestão - @yield('titulo')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}">
</head>

<body>
    <!-- fazendo o include do topo do site -->
    @include('site.layouts._partials.topo')
    <!-- aqui marcamos aonde vamos colocar o conteudo dentro do html -->
    @yield('conteudo')
</body>
</html>
