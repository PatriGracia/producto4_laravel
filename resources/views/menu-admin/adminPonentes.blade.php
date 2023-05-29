@extends('layouts.plantilla')

@section('title', 'Administrador')

@section('css')
    <!-- Scripts CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu-usuario.css')}}">

@endsection

@section('content')

<div class="col-auto d-flex">
    <h1 style="color:rgb(136, 136, 183);">¡Bienvenido/a @auth
        {{Auth::user()->Username}}
    @endauth! </h1>
</div>
<div class="col-auto d-flex">
    <a href="{{route('perfil.index')}}">
        <button class="btn btn-primary perfil"> Perfil </button> 
    </a> 
    <a href="{{route('logout')}}">
        <button class="btn btn-primary log-out" id="logoutButton">Log Out</button>
    </a>
</div>
</div>
</div>
    <div class="row">
        <div class="col-md-12">
            <h2>Administración de eventos</h2>
            <p>Aquí puedes gestionar los eventos, ponentes, tipos de eventos y asistentes.</p>
            <div class="menu-admin">
            
                <a href="{{route('acto.index')}}" class="btn btn-primary boton-admin">Gestionar eventos</a>
                <a href="{{route('ponente.index')}}" class="btn btn-secondary boton-admin">Gestionar ponentes</a>
                <a href="{{route('tipo_acto.index')}}" class="btn btn-primary boton-admin">Gestionar tipos de eventos</a>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <h1 class="text-center">Gestión de Ponentes</h1>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#addPonenteModal">Añadir Ponente</button>
            </div>
            <div class="col-md-9">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modifyPonenteModal">Modificar Ponente</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePonenteModal">Eliminar Ponente</button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h2 class="text-center">Lista de Ponentes</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de usuario</th>
                            <th>Nombre</th>
                            <th>Primer apellido</th>
                            <th>Segundo apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->apellido1 }}</td>
                            <td>{{ $user->apellido2 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para modificar ponente -->
    <div class="modal fade" id="modifyPonenteModal" tabindex="-1" role="dialog" aria-labelledby="modifyPonenteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyPonenteModalLabel">Modificar Ponente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ponente.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="modify_id" value="">
                        <div class="form-group">
                            <label for="id_persona">ID del Ponente:</label>
                            <input type="number" class="form-control" id="id_persona" name="id_persona" required>
                        </div>
                        <div class="form-group">
                            <label for="modify_username">Nombre de usuario:</label>
                            <input type="text" class="form-control" id="modify_username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="modify_nombre">Nombre:</label>
                            <input type="text" class="form-control" id="modify_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="modify_apellido1">Primer apellido:</label>
                            <input type="text" class="form-control" id="modify_apellido1" name="apellido1" required>
                        </div>
                        <div class="form-group">
                            <label for="modify_apellido2">Segundo apellido:</label>
                            <input type="text" class="form-control" id="modify_apellido2" name="apellido2" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Modificar Ponente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para añadir ponente -->
    <div class="modal fade" id="addPonenteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Ponente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ponente.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido1">Primer Apellido:</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido2">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Nombre de Usuario:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" name="id_tipo_usuario" value="3">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Añadir Ponente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar ponente -->
    <div class="modal fade" id="deletePonenteModal" tabindex="-1" role="dialog" aria-labelledby="deletePonenteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePonenteModalLabel">Eliminar Ponente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ponente.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="delete_id" value="">
                        <div class="form-group">
                            <label for="id_persona">ID del Ponente:</label>
                            <input type="number" class="form-control" id="id_persona" name="id_persona" required>
                        </div>
                        <p>¿Está seguro de que desea eliminar al ponente seleccionado?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar Ponente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection