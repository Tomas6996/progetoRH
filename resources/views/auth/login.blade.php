<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    
    <style>    
     /* Estilo do cabeçalho do formulário */ 
        .titulo h2 { 
        color: #333; 
        font-size: 28px; 
        margin-bottom: 10px; 
        font-weight: bold; 
        } 
        .titulo h4 { 
        color: #777; 
        font-size: 16px; 
        margin-bottom: 30px; 
        } 
        </style> 

</head>
<body>
    
    <div class = "base" >
<div class="formulario">
    <div class="titulo">
<h2>LOGIN</h2>
<H4>Sistema Rh</H4>
    </div>
<form action="{{route('login')}}" method="post" enctype="">
    @csrf
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu email" required autofocus> 
    </div>
<div class="form-group">
    <label for="">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha" required> 
</div>
<div class="form-group">
    <button type="submit">Entrar</button>
</div>
</form>
</div>
    </div>
</body>
</html>