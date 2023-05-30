<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use App\Models\Documentacion;
use App\Models\Inscritos;
use App\Models\Lista_Ponentes;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class ActoController extends Controller
{
    public function index(){

        $id= Auth::user()->Id_Persona;
        $tipo_usuario = Auth::user()->Id_tipo_usuario;
        $query1 = Inscritos::select('id_acto')->where('Id_persona','=', $id)->get();
        $query2 = Lista_Ponentes::select('Id_acto')->where('Id_persona','=', $id)->get();

        
        $listaActos = Acto::whereNotIn('Id_acto', $query1)->whereNotIn('Id_acto', $query2)->orderBy('Fecha', 'asc')->get();
        $listaActosInscritos = Acto::whereIn('Id_acto', $query1)->orderBy('Fecha', 'asc')->get();
        $listaActosPonentes = Acto::whereIn('Id_acto', $query2)->orderBy('Fecha', 'asc')->get();

        $documents = Documentacion::where('Id_persona', '=', $id)->orderBy('Orden', 'asc')->get();

        if($tipo_usuario == 1){
            return view('menu-admin/adminEvents', compact('listaActos', 'listaActosInscritos', 'listaActosPonentes'));
        }elseif($tipo_usuario == 2){
            return view('menu-usuario/usuario', compact('listaActos', 'listaActosInscritos', 'listaActosPonentes'));
        }else{
            return view('menu-ponente/ponente', compact('listaActos', 'listaActosInscritos', 'listaActosPonentes', 'documents'));
        } 
    }

    public function apiIndex(){
        $futureEvents = Acto::join('Tipo_acto', 'Actos.Id_tipo_acto', '=', 'Tipo_acto.Id_tipo_acto')
                            ->where('Fecha', '>', Carbon::now())
                            ->get(['Fecha', 'Hora', 'Titulo', 'Descripcion as Tipo', 'Actos.Id_acto']);

        // Preparar los datos para la respuesta JSON
        $response = $futureEvents->map(function ($event) {
            return [
                'Fecha' => $event->Fecha,
                'Hora' => $event->Hora,
                'Titulo' => $event->Titulo,
                'Tipo' => $event->Tipo,
                'URL' => route('acto.showEvent', ['id' => $event->Id_acto])
            ];
        });

        return response()->json($response);
    }

    public function showEvent(Request $request){
        $acto = Acto::where('Id_acto', '=', $request->input('id_acto'))->first();

        $query3 = Inscritos::select('Id_persona')->where('id_acto', '=', $request->id_acto);
        $asistentes = Usuario::select('Id_usuario', 'Username')->whereIn('Id_Persona', $query3)->get();
        $no_inscritos = Usuario::select('Id_usuario', 'Username')->whereNotIn('Id_Persona', $query3)->get();

        $documents = Documentacion::where('Id_acto', '=', $request->id_acto)->orderBy('Orden', 'asc')->get();

        return view('events/showEvent', compact('acto', 'asistentes', 'no_inscritos', 'documents'));
    }

    public static function datoInscribir($id){
        $user = Auth::user()->Id_Persona;
        $datoIns = Inscritos::where('Id_persona', '=', $user)->where('id_acto', '=', $id)->first();

        return $datoIns;
    }

    public function inscribirDesinscribir(Request $request){
        if(Auth::check()){
            $ya_inscritos = Inscritos::where('id_acto', '=', $request->input('id_acto'))->count();
            $num_asistentes = Acto::where('Id_acto', '=', $request->input('id_acto'))->first();
            $maximo_inscritos = $num_asistentes->Num_asistentes;
            if($request->input('inscribirDesinscribir') === 'inscribirse'){
                if($ya_inscritos < $maximo_inscritos){
                    $inscrito = new Inscritos;
                    $inscrito->Id_persona = $request->input('id_persona');
                    $inscrito->id_acto = $request->input('id_acto');
                    $inscrito->Fecha_inscripcion = date('Y-m-d H:i:s');
                    $inscrito->save();
                    echo "<script>alert('Confirmada la inscripción al acto')</script>";
                }
                else{
                    echo "<script>alert('No es posible la inscripción. El aforo está completo')</script>";
                }
                
            }else{
                $delete = Inscritos::where('Id_persona', '=', $request->input('id_persona'))->where('id_acto', '=', $request->input('id_acto'))->delete();
                echo "<script>alert('Eliminada la inscripción al acto')</script>";
            }

            $acto = Acto::where('Id_acto', '=', $request->input('id_acto'))->first();
            $query3 = Inscritos::select('Id_persona')->where('id_acto', '=', $request->id_acto);
            $asistentes = Usuario::whereIn('Id_Persona', $query3)->get();
            $no_inscritos = Usuario::whereNotIn('Id_Persona', $query3)->get();

            $documents = Documentacion::where('Id_acto', '=', $request->id_acto)->orderBy('Orden', 'asc')->get();

            return view('events/showEvent', compact('acto', 'asistentes', 'no_inscritos', 'documents'));
        }else{
            echo "<script>alert('Inicia sesión o regístrate para Inscribirte')</script>"; 
            
            return view('auth/login'); 
        } 
    }

    public function create(Request $request){
        $acto = new Acto;
        $acto->Fecha = $request->Fecha;
        $acto->Hora = $request->HoraInicio;
        $acto->Titulo = $request->Titulo;
        $acto->Descripcion_corta = $request->Descripcion_corta;
        $acto->Descripcion_larga = $request->Descripcion_larga;
        $acto->Num_asistentes = $request->Num_asistentes;
        $acto->Id_tipo_acto = $request->Id_tipo_acto;
        $acto->save();
        
        return redirect(route('acto.index'));

    }

    public function edit(Request $request){
        $id = $request->id_acto;

        if($request->Titulo != null){
            Acto::where('Id_acto', '=', $id)->update(['Titulo' => $request->Titulo]);
        }if($request->Id_tipo_acto != null){
            Acto::where('Id_acto', '=', $id)->update(['Id_tipo_acto' => $request->Id_tipo_acto]);
        }if($request->Fecha != null){
            Acto::where('Id_acto', '=', $id)->update(['Fecha' => $request->Fecha]);
        }if($request->HoraInicio != null){
            Acto::where('Id_acto', '=', $id)->update(['Hora' => $request->HoraInicio]); 
        }if($request->Descripcion_corta != null){
            Acto::where('Id_acto', '=', $id)->update(['Descripcion_corta' => $request->Descripcion_corta]); 
        }if($request->Descripcion_larga != null){
            Acto::where('Id_acto', '=', $id)->update(['Descripcion_larga' => $request->Descripcion_larga]); 
        }if($request->Num_asistentes != null){
            Acto::where('Id_acto', '=', $id)->update(['Num_asistentes' => $request->Num_asistentes]); 
        }
        
        return redirect(route('acto.index'));  
    }

    public function delete(Request $request){
        $id = $request->id_acto;
        Acto::where('Id_acto', '=', $id)->delete();

        return redirect(route('acto.index'));
    }

    public function allEvent(){
        $listaActos = Acto::all();
        return view('events/allEvent', compact('listaActos'));
    }

    public function subirArchivo(Request $request){
        //Recibimos el archivo y lo guardamos en la carpeta storage/app/public
        //$file = $request->file('archivo');
        //$file->store('public');
        //$name = $file->getClientOriginalName();
        //echo "<script>alert('Archivo subido correctamente')</script>";
        //dd("subido y guardado");
        //return $name;
        $file = $request->file('archivo');
        $ext = $file->getClientOriginalExtension();

        if($ext == "pdf" || $ext == "doc" || $ext == "docx" || $ext == "txt"){
            
            $file_path = $file->store("","local_custom");
            $documentacion = new Documentacion;
            $documentacion->Id_acto = $request->id_acto;
            $documentacion->Localizacion_documentacion = $file_path;
            $documentacion->Orden = $request->orden;
            $documentacion->Id_persona = Auth::user()->Id_Persona;
            $documentacion->Titulo_documento = $file->getClientOriginalName();
            $documentacion->save();

        }else{
            echo "<script>alert('Debe subir un archivo .pdf, .doc, .docx o .txt')</script>";
        }

        return redirect(route('acto.index'));
        
    }
}