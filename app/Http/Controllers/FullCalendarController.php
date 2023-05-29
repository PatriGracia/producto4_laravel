<?php

namespace App\Http\Controllers;

use App\Models\Inscritos;
use App\Models\Lista_Ponentes;
use Illuminate\Http\Request;
use App\Models\Acto;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class FullCalendarController extends Controller
{
    public function index(){
        //$listaActos = new Acto;
        
        $id=3;
        $query1 = Inscritos::select('id_acto')->where('Id_persona','=', $id)->get();
        $query2 = Lista_Ponentes::select('Id_acto')->where('Id_persona','=', $id)->get();

        $listaActos = Acto::select('Id_acto AS id', 'Fecha AS start', 'Titulo as title' )->whereNotIn('Id_acto', $query1)->whereNotIn('Id_acto', $query2)->get();
        $events = [
            $id =  $listaActos->Id_acto,
            $start = $listaActos->Fecha,
            $title = $listaActos->Titulo
        ];
            
        //return response()->json($events);
        //return view('ponente', compact('actos'));
       // return response()->json($listaActos);
       //return json_encode($listaActos);
       return $listaActos;
        

    }
    /*
    public function listarActosInscritos($id){
        
    }

    public function listarActosPonente($id){
        
    }*/

   /* public function index(Request $request)
    {
        if($request->ajax()) {  
            $data = Acto::whereDate('Fecha', '>=', $request->start)
                ->get(['Id_acto', 'Titulo', 'Fecha']);
            return response()->json($data);
        }
        return view('ponente');
    }*/
 
    public function calendarEvents(Request $request)
    {
 
        switch ($request->type) {
           case 'create':
              $event = Acto::create([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'edit':
              $event = Acto::find($request->id)->update([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Acto::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # ...
             break;
        }
    }

}
