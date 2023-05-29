<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to LAMP Infrastructure</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="row align-items-center header">
        <div class="col">
            <h3 class="text-primary"> <strong>Grupo PSMD </strong></h3>
            <h4 class="nombre-proyecto"> Gestión de Eventos </h4>
        </div>
        <div class="col-auto d-flex">

            @if (Route::current()->uri == 'login' || Route::current()->uri == '/')
                <a class="btn btn-primary registro" href="{{ route('registro') }}"> Registro </a>
            @endif
            
            @if(Route::current()->uri == 'login' || Route::current()->uri == 'registro')
                <a class="btn btn-primary volver ml-2" href="/"> Volver </a>
            @endif

            @if (Route::current()->uri == 'registro' || Route::current()->uri == '/')
                <a class="btn btn-primary acceso" href="{{ route('login') }}"> Acceso </a>
            @endif

            @if (Route::current()->uri == 'admin' || Route::current()->uri == 'ponente' || Route::current()->uri == 'usuario')
                <a class="btn btn-primary acceso" href="{{ route('perfil') }}"> Perfil </a>
                <a class="btn btn-primary acceso" href="{{ route('logout') }}"> Logout </a>
            @endif

        </div>
    </div>
    <main>
        @yield("content")
    </main>
</body>
</html>