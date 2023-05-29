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
                <a href="{{route('ponente.index')}}" class="btn btn-primary boton-admin">Gestionar ponentes</a>
                <a href="{{route('tipo_acto.index')}}" class="btn btn-secondary boton-admin">Gestionar tipos de eventos</a>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <h1 class="text-center">Gestión de Tipos de Eventos</h1>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#addTipoEventoModal">Añadir Tipo de Evento</button>
            </div>
            <div class="col-md-9">
                <form class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifyTipoEventoModal">Modificar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTipoEventoModal">Eliminar</button>
                </form>
            </div>
            <div class="row">
            <div class="col">
                <h2 class="text-center">Lista de Tipos de Acto</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipoactos as $tipoacto)
                        <tr>
                            <td>{{ $tipoacto->Id_tipo_acto }}</td>
                            <td>{{ $tipoacto->Descripcion }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal para añadir tipo de evento -->
    <div class="modal fade" id="addTipoEventoModal" tabindex="-1" role="dialog" aria-labelledby="addTipoEventoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tipo_acto.store') }}" method="post">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTipoEventoModalLabel">Añadir Tipo de Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para modificar tipo de evento -->
    <div class="modal fade" id="modifyTipoEventoModal" tabindex="-1" role="dialog" aria-labelledby="modifyTipoEventoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="modifyTipoEventoForm" action="{{ route('tipo_acto.update') }}" method="post">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyTipoEventoModalLabel">Modificar Tipo de Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_tipo_acto">ID del Tipo de Evento:</label>
                            <input type="number" class="form-control" id="id_tipo_acto" name="id_tipo_acto">
                        </div>
                        <div class="form-group">
                            <label for="modify_descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="modify_descripcion" name="modify_descripcion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar tipo de evento -->
    <div class="modal fade" id="deleteTipoEventoModal" tabindex="-1" role="dialog" aria-labelledby="deleteTipoEventoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tipo_acto.delete') }}" method="post">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTipoEventoModalLabel">Eliminar Tipo de Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_tipo_acto">ID del Tipo de Evento:</label>
                            <input type="number" class="form-control" id="id_tipo_acto" name="id_tipo_acto">
                        </div>
                        <p>¿Está seguro de que desea eliminar este tipo de evento?</p>
                        <input type="hidden" id="delete_id" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

</div>

@endsection