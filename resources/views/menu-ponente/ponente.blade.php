@extends('layouts.plantilla')

@section('title', 'Ponente')

@section('css')
    <!-- Scripts CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu-ponente.css')}}">

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
            <div class="col-6 offset-md-1">
                <div id="Calendario_Ponente" style="margin-bottom:1em; height:500px; border: 1px solid #000; overflow: auto; padding: 1em; margin-top: 70px">
                    <h5>Calendario de Eventos:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th></th> <!-- Columna para el botón de Ver Evento -->
                                <th></th> <!-- Nueva columna para el botón de Subir Archivo -->
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
                                    <td>
                                        <form action="{{route('acto.showEvent')}}" method="POST">
                                            @csrf
                                            <input name="id_acto" type="hidden" value="{{$listaActosPonente->Id_acto}}">
                                            <button type="submit" class="btn btn-light">Ver evento</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Botón para subir un archivo solo si el evento ya ha terminado -->
                                        @if($listaActosPonente->Fecha < now())
                                            <form action="{{ route('documento.subir', $listaActosPonente->Id_acto) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="documento" accept=".pdf,.doc,.docx,.txt">
                                                <button type="submit" class="btn btn-light">Subir archivo</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="col-4">
            <div id="Documentacion" style="margin-bottom:1em; height:500px; border: 1px solid #000; overflow: auto; padding: 1em; margin-top: 70px">
                <h5>Resumen documentacion de mis actos como ponente:</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#Presentacion</th>
                            <th>#Acto</th>
                            <th>Localizacion doc</th>
                            <th>Orden</th>
                            <th>#Persona</th>
                            <th>Titulo doc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $document)
			                    <tr>
                                    <td>{{ $document->Id_presentacion }}</td>
                                    <td>{{ $document->Id_acto }}</td>
                                    <td>{{ $document->Localizacion_documentacion }}</td>
                                    <td>{{ $document->Orden }}</td>
                                    <td>{{ $document->Id_persona }}</td>
                                    <td>{{ $document->Titulo_documento }}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
