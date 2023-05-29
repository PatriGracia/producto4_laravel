<?php
 
namespace App\Http\Controllers;
 
use App\Models\Acto;
use App\Models\Inscritos;
use App\Models\Lista_Ponentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Usuario;
use App\Models\Persona;

 
class LoginController extends Controller {
    
    public function register(Request $request) {
        //Validar los datos
        $usuario = new Usuario();
        $persona = new Persona();  
        $Id_ultima_persona = null;
        $tipo_usuario = 2;
        //name, apellido1, apellido2, username, password  
        $persona->Nombre = $request->name;   
        $persona->Apellido1 = $request->apellido1;
        $persona->Apellido2 = $request->apellido2; 
        //guardar persona
        $persona->save();
        $Id_ultima_persona = Persona::latest('Id_persona')->first()->Id_persona;
        $usuario->Username = $request->username;
        $usuario->Password = $request->password;
        $usuario->Id_Persona = $Id_ultima_persona;
        //$persona->Id_persona;
        $usuario->Id_tipo_usuario = $tipo_usuario;
        $usuario->save();

        Auth::login($usuario);

        return redirect(route('login'));
        
        
    }

    public function login(Request $request) {

        $usuarioLog = Usuario::where('Username','=', $request->username)->first();
        $usuarioId = Usuario::where('Username','=', $request->username)->first()->Id_persona;
        if($usuarioLog->Username == $request->username && $request->password == $usuarioLog->Password){
            
            $request->session()->regenerateToken();

                if($usuarioLog->Id_tipo_usuario == 1){
                    Auth::login($usuarioLog);
                    return redirect(route('admin'));
                }elseif($usuarioLog->Id_tipo_usuario == 2){
                    Auth::login($usuarioLog);
                    return redirect(route('acto.index'));
                }elseif($usuarioLog->Id_tipo_usuario == 3){
                    Auth::login($usuarioLog);
                    return redirect(route('acto.index'));
                }
            
        }else{
            return redirect(route('login')); 
        }
    }

    public function logout(Request $request) {
        //return view('auth/login');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}

?>