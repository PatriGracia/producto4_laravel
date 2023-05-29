@extends('layouts.plantilla')

@section('title', 'Eventos')

@section('css')
    <!-- Scripts CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">

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
                
                    <a href="{{route('acto.index')}}" class="btn btn-secondary boton-admin">Gestionar eventos</a>
                    <a href="{{route('ponente.index')}}" class="btn btn-primary boton-admin">Gestionar ponentes</a>
                    <a href="{{route('tipo_acto.index')}}" class="btn btn-primary boton-admin">Gestionar tipos de eventos</a>
                </div>
            </div>
        </div>
    </div>


        <div class="row">
            <div class="col-8 offset-md-1">
                <div id="Calendario_Ponente" style="margin-bottom:1em; height:500px; border: 1px solid #000; overflow: auto; padding: 1em; margin-top: 70px">
                    <h5>Calendario de Eventos:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaActos as $listaActo)
			                    <tr  style='background-color:white'>
                                    <td>{{ $listaActo->Titulo }}</td>
                                    <td>{{ $listaActo->Fecha }}</td>
                                    <td>{{ $listaActo->Hora }}</td>
                                    <td><form action="{{route('acto.showEvent')}}" method="POST">
                                        @csrf
                                        <input name="id_acto" type="hidden" value="{{$listaActo->Id_acto}}">
                                        <button type="submit" class="btn btn-light">Ver evento</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($listaActosInscritos as $listaActosInscrito)
			                    <tr  style='background-color:#56CBF7'>
                                    <td>{{ $listaActosInscrito->Titulo }}</td>
                                    <td>{{ $listaActosInscrito->Fecha }}</td>
                                    <td>{{ $listaActosInscrito->Hora }}</td>
                                    <td><form action="{{route('acto.showEvent')}}" method="POST">
                                        @csrf
                                        <input name="id_acto" type="hidden" value="{{$listaActosInscrito->Id_acto}}">
                                        <button type="submit" class="btn btn-light">Ver evento</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($listaActosPonentes as $listaActosPonente)
			                    <tr  style='background-color:#F79D56'>
                                    <td>{{ $listaActosPonente->Titulo }}</td>
                                    <td>{{ $listaActosPonente->Fecha }}</td>
                                    <td>{{ $listaActosPonente->Hora }}</td>
                                    <td><form action="{{route('acto.showEvent')}}" method="POST">
                                        @csrf
                                        <input name="id_acto" type="hidden" value="{{$listaActosPonente->Id_acto}}">
                                        <button type="submit" class="btn btn-light">Ver evento</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>                    
                </div>
            </div>
            
    </div>
    <form action="{{route('admin')}}" method="GET">
        @csrf 
        <button type="submit" name="acto.index" class="btn btn-light" style="margin-left: 200px">Volver</button>
    </form>

    @csrf 
    <button type="submit" name="" class="btn btn-success" data-toggle="modal" data-target="#nuevoActo" style="margin-left: 1200px; margin-top: -65px">Nuevo Acto
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-plus" viewBox="0 0 16 16">
            <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
        </svg>
    </button>

    

<!-- MODAL NUEVO ACTO -->
    <div class="modal" id="nuevoActo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Acto</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('acto.create')}}" >
                        @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Titulo del evento: </label>
                            <input type="text" id="Titulo" name="Titulo" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="">Tipo de Acto:</label>
                            <select id="Id_tipo_acto" name="Id_tipo_acto" class="form-control" required>
                                @php
                                    $tipos = App\Http\Controllers\Tipo_actoController::getTipo_acto(); 
                                @endphp
                                @foreach ($tipos as $tipo)
                                    <option value= {{ $tipo->Id_tipo_acto }} > {{ $tipo->Descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Fecha:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="date" id="Fecha" name="Fecha" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="TituloHoraInicio">
                            <label for="">Hora de inicio:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" id="HoraInicio" name="HoraInicio" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Breve descripcion:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="text" id="Descripcion_corta" name="Descripcion_corta" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Descripcion larga:</label>
                            <div class="input-group" data-autoclose="true">
                                <textarea id="Descripcion_larga" name="Descripcion_larga" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Numero de asistentes:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="number" id="Num_asistentes" name="Num_asistentes" min="0" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="BotonAgregar" class="btn btn-sucess">Agregar</button>
                    <button type="button" class="btn btn-sucess" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection