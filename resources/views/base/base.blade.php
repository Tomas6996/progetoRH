<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
</head>
<body>
    <div class="menu menu2 menu4" id="menu">
        <div class="logo">
            <h4>Logotipo</h4>
        </div>
        <div  class="users">
            <a href=""><i class="fa fa-user"></i></a>
            <a href="{{route('sair')}}"><i class="fa fa-power-off"></i></a>
        </div>
    </div>
    <div class="corpo">
        <div class="menuLateral">
            <ul>
                <li><a href="">Dashboard</a></li>
                <li><a href="{{route('usuario')}}">Usuario</a></li>
                <li><a href="{{route('funcionario')}}">Funcionario</a></li>
                <li><a href="{{route('recrutamento')}}">Recrutamento</a></li>
                <li><a href="{{route('ferias')}}">Ferias</a></li>
                <li><a href="">faltas</a></li>
                <li><a href="">salario</a></li>
                <li><a href="">Avaliação Desempenho</a></li>
                <li><a href="">Relatorios de ferias</a></li>
                <li><a href="">Relatorios de faltas</a></li>
            </ul>
        </div>
        <div class="conteudo">
            @yield('gestao')
        </div>
    </div>
    <div>
        <h1>Rodape</h1>
    </div>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <script>
        $(function(){
            $('.alert').fadeOut(1000)
        })
    </script>
</body>
</html>