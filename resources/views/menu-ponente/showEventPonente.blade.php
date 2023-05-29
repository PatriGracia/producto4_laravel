@extends('layouts.plantilla')

@section('title', 'showEvent')

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
                <button class="btn btn-primary perfil"> Perfil </button> 
                <button id="logoutButton" class="btn btn-primary log-out"> Log Out </button>
            </div>
        </div>
    </div>

    <div class="col-10 offset-md-1">
        <div id="Evento" style="margin-bottom:1em; height:500px; border: 1px solid #000; overflow: auto; padding: 1em; margin-top: 70px">
            <h5>Información del Acto:</h5>
            <table class="table table-bordered table-striped" style="margin-top: 20px">
                <thead>
                    <tr>
                        <th>#Acto</th>
                        <th>Titulo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Resumen</th>
                        <th>Descripción</th>
                        <th>Asistentes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $acto->Id_acto }}</td>
                        <td>{{ $acto->Titulo }}</td>
                        <td>{{ $acto->Fecha }}</td>
                        <td>{{ $acto->Hora }}</td>
                        <td>{{ $acto->Descripcion_corta }}</td>
                        <td>{{ $acto->Descripcion_larga }}</td>
                        <td>{{ $acto->Num_asistentes }}</td>
                    </tr>

                    <tr>
                        @php
                            $datoIns = App\Http\Controllers\PonenteController::datoInscribir($acto->Id_acto);
                            
                        @endphp
                        
                        @if ($datoIns == null) 
                            <form method="POST" action="{{route('ponente.inscribirDesinscribir')}}">
                                @csrf
                                <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                <input name="id_persona" type="hidden" value="{{Auth::user()->Id_Persona}}">
                                <button type="submit" name="inscribirDesinscribir" value="inscribirse" class="btn btn-warning">Inscribirse</button>
                            </form>  
                        @else
                            <form method="POST" action="{{route('ponente.inscribirDesinscribir')}}">
                                @csrf
                                <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                <input name="id_persona" type="hidden" value="{{Auth::user()->Id_Persona}}">
                                <button type="submit" name="inscribirDesinscribir" value="desinscribirse" class="btn btn-warning">Desinscribirse</button>
                            </form>
                            
                        
                        @endif
                    </tr>
                </tbody>
            </table>
            <form action="{{route('ponente.index')}}" method="GET">
                @csrf 
               <button type="submit" name="ponente.index" class="btn btn-light">Volver</button>
            </form>
        </div>
    </div>
</div>

@endsection