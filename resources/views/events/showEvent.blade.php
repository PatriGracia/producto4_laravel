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
                <a href="{{route('perfil.index')}}">
                    <button class="btn btn-primary perfil"> Perfil </button> 
                </a> 
                <a href="{{route('logout')}}">
                    <button class="btn btn-primary log-out" id="logoutButton">Log Out</button>
                </a>
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
                        <th>Número de Asistentes</th>
                        <th>Lista de Asistentes</th>
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
                        <td>
                            @auth
                                @foreach ($asistentes as $asistente)
                                    <ul>
                                        <li>{{$asistente->Username}}</li>
                                    </ul>
                                @endforeach
                            @endauth
                        </td>
                    </tr>

                    <tr>
                        @auth
                            @php
                                $datoIns = App\Http\Controllers\ActoController::datoInscribir($acto->Id_acto);
                                
                            @endphp
                            
                            @if ($datoIns == null) 
                                <form method="POST" action="{{route('acto.inscribirDesinscribir')}}">
                                    @csrf
                                    <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                    <input name="id_persona" type="hidden" value="{{Auth::user()->Id_Persona}}">
                                    <button type="submit" name="inscribirDesinscribir" value="inscribirse" class="btn btn-warning">Inscribirse</button>
                                </form>  
                            @else
                                <form method="POST" action="{{route('acto.inscribirDesinscribir')}}">
                                    @csrf
                                    <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                    <input name="id_persona" type="hidden" value="{{Auth::user()->Id_Persona}}">
                                    <button type="submit" name="inscribirDesinscribir" value="desinscribirse" class="btn btn-warning">Desinscribirse</button>
                                </form>
                                
                            
                            @endif
                        @endauth
                    </tr>
                </tbody>
            </table>
            @auth
                @if(Auth::user()->Id_tipo_usuario == 1)
                    @csrf
                    <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#editarActo">Editar
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>
                    
                    @csrf
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteActo">Eliminar
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                        </svg>
                    </button>
                    
                    @csrf
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#asistentesActo">Gestionar Asistentes
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                            <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                        </svg>
                    </button>
                @endif
            @endauth

            <!-- footer-->

            <form action="{{route('acto.allEvent')}}" method="GET">
                @csrf 
               <button type="submit" name="acto.allEvent" class="btn btn-light" style="margin-top: 20px">Volver</button>
            </form>

        </div>
    </div>
</div>

<!--MODAL EDITAR ACTO-->

<div class="modal" id="editarActo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edita los campos que quieras modificar</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('acto.edit')}}" >
                    @csrf
                    <div class="form-row">
                        <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                        <div class="form-group col-md-12">
                            <label for="">Titulo del evento: </label>
                            <input type="text" id="Titulo" name="Titulo" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="">Tipo de Acto:</label>
                            <select id="Id_tipo_acto" name="Id_tipo_acto" class="form-control">
                                @php
                                    $tipos = App\Http\Controllers\Tipo_actoController::getTipo_acto(); 
                                @endphp
                                @foreach ($tipos as $tipo)
                                    <option value={{$tipo->Id_tipo_acto}}>{{$tipo->Descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Fecha:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="date" id="Fecha" name="Fecha" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="TituloHoraInicio">
                            <label for="">Hora de inicio:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" id="HoraInicio" name="HoraInicio" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Breve descripcion:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="text" id="Descripcion_corta" name="Descripcion_corta" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Descripcion larga:</label>
                            <div class="input-group" data-autoclose="true">
                                <textarea id="Descripcion_larga" name="Descripcion_larga" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Numero de asistentes:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="number" id="Num_asistentes" name="Num_asistentes" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" id="BotonAgregar" class="btn btn-sucess">Editar</button>
                <button type="button" class="btn btn-sucess" data-dismiss="modal">Cancelar</button>
            </div>

        </form>
        </div>
    </div>
</div>


<!--MODAL ELIMINAR ACTO-->

<div class="modal" id="deleteActo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirma eliminar el acto {{$acto->Titulo}}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('acto.delete')}}" >
                    @csrf
                    <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">      
            </div>
            
                <div class="modal-footer">
                    <button type="submit" id="BotonEliminar" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-sucess" data-dismiss="modal">Cancelar</button>
                </div>
                </form>
        </div>
    </div>
</div>

<!--MODAL ASISTENTES ACTO-->

<div class="modal" id="asistentesActo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añade o elimina asistentes</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" >
                    @csrf
                    <h6>Asistentes al acto</h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asistentes as $asistente)
			                    <tr>
                                    <td>{{ $asistente->Id_usuario }}</td>
                                    <td>{{ $asistente->Username }}</td>
                                    <td>
                                        <form method="POST" action="{{route('acto.inscribirDesinscribir')}}">
                                            @csrf
                                            <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                            <input name="id_persona" type="hidden" value="{{$asistente->Id_usuario}}">
                                            <button type="submit"  name="inscribirDesinscribir" value="desinscribirse" class="btn btn-danger" style="margin-top: 20px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h6>Usuarios no inscritos</h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($no_inscritos as $no_inscrito)
			                    <tr>
                                    <td>{{ $no_inscrito->Id_usuario }}</td>
                                    <td>{{ $no_inscrito->Username }}</td>
                                    <td>
                                        
                                        <form method="POST" action="{{route('acto.inscribirDesinscribir')}}">
                                            @csrf
                                            <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                            <input name="id_persona" type="hidden" value="{{$no_inscrito->Id_usuario}}"> 
                                            <button type="submit" name="inscribirDesinscribir" value="inscribirse" class="btn btn-success" style="margin-top: 20px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
            </div>
            <div class="modal-footer">
                <button type="submit" id="BotonAgregar" class="btn btn-sucess">Editar</button>
                <button type="button" class="btn btn-sucess" data-dismiss="modal">Cancelar</button>
            </div>

        </form>
        </div>
    </div>
</div>


@endsection