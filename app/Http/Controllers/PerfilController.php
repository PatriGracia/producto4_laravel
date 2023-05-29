<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index(){
        $id = Auth::user()->Id_Persona;

        $persona = Persona::where('Id_persona', '=', $id)->first();
        $usuario = Usuario::where('Id_Persona', '=', $id)->first();
        $p = Usuario::select('Password')->where('Id_Persona', '=', $id)->first();
        $password = Hash::make($p);
        return view('perfil', compact('usuario', 'persona', 'password'));
    }

    public function modificar(Request $request){
        $id = Auth::user()->Id_Persona;
        if($request->mod_name != null){
            Persona::where('Id_persona', '=', $id)->update(['Nombre' => $request->mod_name]);
        }if($request->mod_apellido1 != null){
            Persona::where('Id_persona', '=', $id)->update(['Apellido1' => $request->mod_apellido1]);
        }if($request->mod_apellido2 != null){
            Persona::where('Id_persona', '=', $id)->update(['Apellido2' => $request->mod_apellido2]);
        }if($request->mod_username != null){
            Usuario::where('Id_Persona', '=', $id)->update(['Username' => $request->mod_username]); 
        }if($request->mod_password != null){
            if($request->mod_password == $request->mod_password_confirm){
                Usuario::where('Id_Persona', '=', $id)->update(['Password' => $request->mod_password]);
            }else{
                echo "<script>alert('Las contraseñas no coinciden')</script>";
            }    
        }
        echo "<script>alert('Usuario actualizado correctamente')</script>";
        return redirect()->route('perfil.index');
    }
}