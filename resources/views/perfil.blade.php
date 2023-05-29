@extends('layouts.plantilla')

@section('title', 'Perfil')

@section('css')
    <!-- Scripts CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">

@endsection

@section('content')

<div class="col-auto d-flex">
    
    <a href="{{route('acto.index')}}">
        <button class="btn btn-danger" id="volver">Volver</button> 
    </a>
    <a href="{{route('logout')}}">
        <button class="btn btn-primary log-out" id="logoutButton">Log Out</button>
    </a> 
    
</div>
</div>
</div>

<!-- Cuerpo -->
<div class="row"> 
    <div class="col-md-4 offset-md-1">
        <table class="table table-bordered table-striped col-md-3 offset-md-1" style="margin-top: 70px" >
            <tr>
                <th># Usuario</th>
                <td>
                    {{$usuario->Id_usuario}}
                </td>
            </tr>
            <tr>
                <th>Nombre </th>
                <td>
                    {{$persona->Nombre}}
                </td>
            </tr>
            <tr>
                <th>Primer apellido </th>
                <td>
                    {{$persona->Apellido1}}
                </td>
            </tr>
            <tr>
                <th>Segundo apellido </th>
                <td>
                    {{$persona->Apellido2}}
                </td>
            </tr>
            <tr>
                <th>Username </th>
                <td>
                    {{$usuario->Username}}
                </td>
            </tr>
            <tr>
                <th>Contraseña</th>
                <td>
                    {{$password}}
                </td>
            </tr>
        </table>
    </div>


    <div class="col-md-4 offset-md-1">
        <h2>Modificar Usuario</h2>
        <div class="contenedor-modificar">
            <form method="POST" action="{{route('perfil.modificar')}}" >
                @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-4">
                            <label for="mod_name">Nombre:</label>
                            <input type="text" class="form-control" id="mod_name" name="mod_name">
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <label for="mod_apellido1">Apellido 1:</label>
                            <input type="text" class="form-control" id="mod_apellido1" name="mod_apellido1">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="mod_apellido2">Apellido 2:</label>
                        <input type="text" class="form-control" id="mod_apellido2" name="mod_apellido2">
                    </div>
                    <div class="form-group mb-4">
                        <label for="mod_username">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="mod_username" name="mod_username">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-4">
                            <label for="mod_password">Contraseña:</label>
                            <input type="password" class="form-control" id="mod_password" name="mod_password">
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <label for="mod_password_confirm">Confirmar contraseña:</label>
                            <input type="password" class="form-control" id="mod_password_confirm" name="mod_password_confirm">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secundary">Modificar</button>
            </form>
        </div>
    </div>
</div>



@endsection