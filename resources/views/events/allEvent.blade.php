@extends('layouts.plantilla')

@section('title', 'Usuario')

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
                <button class="btn btn-primary acceso" onclick="location.href='{{route('login')}}'"> Login </button>
                <button class="btn btn-primary volver ml-2" onclick="location.href='{{route('home')}}'"> Volver </button>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listaActos as $listaActo)
			                    <tr>
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
                        </tbody>
                    </table>
                </div>
            </div>
    </div>


@endsection
