<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Usuario;
use App\Models\Persona;

class PonenteController extends Controller
{
    public function index(){

        $users = Usuario::select('Usuarios.Id_usuario as id', 'Usuarios.Username as username', 'Personas.Nombre as nombre', 'Personas.Apellido1 as apellido1', 'Personas.Apellido2 as apellido2')
            ->join('Personas', 'Usuarios.Id_Persona', '=', 'Personas.Id_persona')
            ->where('Usuarios.Id_tipo_usuario', 3)
            ->get();

        return view('menu-admin/adminPonentes', compact('users'));
    }

    public function update(Request $request){

        DB::table('Usuarios as u')
            ->join('Personas as p', 'u.Id_Persona', '=', 'p.Id_persona')
            ->where('u.Id_usuario', $request->id_persona)
            ->update([
                'u.Username' => $request->username,
                'p.Nombre' => $request->nombre,
                'p.Apellido1' => $request->apellido1,
                'p.Apellido2' => $request->apellido2
            ]);

        $users = Usuario::select('Usuarios.Id_usuario as id', 'Usuarios.Username as username', 'Personas.Nombre as nombre', 'Personas.Apellido1 as apellido1', 'Personas.Apellido2 as apellido2')
            ->join('Personas', 'Usuarios.Id_Persona', '=', 'Personas.Id_persona')
            ->where('Usuarios.Id_tipo_usuario', 3)
            ->get();

        return view('menu-admin/adminPonentes', compact('users'));

    }

    public function destroy(Request $request){
        $user = Usuario::find($request->id_persona);
        $user->delete();
        DB::table('Personas')->where('Id_persona', $request->id_persona)->delete();

        $users = Usuario::select('Usuarios.Id_usuario as id', 'Usuarios.Username as username', 'Personas.Nombre as nombre', 'Personas.Apellido1 as apellido1', 'Personas.Apellido2 as apellido2')
            ->join('Personas', 'Usuarios.Id_Persona', '=', 'Personas.Id_persona')
            ->where('Usuarios.Id_tipo_usuario', 3)
            ->get();

        return view('menu-admin/adminPonentes', compact('users'));
    }

    public function store(Request $request){
        $id_persona = DB::table('Personas')->insertGetId([
            'Nombre' => $request->nombre,
            'Apellido1' => $request->apellido1,
            'Apellido2' => $request->apellido2
        ]);

        DB::table('Usuarios')->insert([
            'Username' => $request->username,
            'Password' => $request->password,
            'Id_Persona' => $id_persona,
            'Id_tipo_usuario' => $request->id_tipo_usuario
        ]);

        $users = Usuario::select('Usuarios.Id_usuario as id', 'Usuarios.Username as username', 'Personas.Nombre as nombre', 'Personas.Apellido1 as apellido1', 'Personas.Apellido2 as apellido2')
            ->join('Personas', 'Usuarios.Id_Persona', '=', 'Personas.Id_persona')
            ->where('Usuarios.Id_tipo_usuario', 3)
            ->get();

        return view('menu-admin/adminPonentes', compact('users'));
    }



}
