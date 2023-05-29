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
                <a href="{{route('tipo_acto.index')}}" class="btn btn-primary boton-admin">Gestionar tipos de eventos</a>
            </div>
        </div>
    </div>
</div>

 <!-- Agrega el botón o enlace para abrir el modal 
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModal">
    Abrir Modal
</button> -->

<!-- Agrega el contenido del modal 
<div class="modal" id="miModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Título del Modal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Contenido del Modal</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div> -->

@endsection