<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_acto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TipoactoController extends Controller
{
    public function index()
    {
        $tipoactos = Tipo_acto::all();
        return view('menu-admin.adminTiposEvento', compact('tipoactos'));
    }
    
    public function store(Request $request)
    {
        DB::table('Tipo_acto')->insert([
            'Descripcion' => $request->descripcion
        ]);

        $tipoactos = Tipo_acto::all();
        return view('menu-admin.adminTiposEvento', compact('tipoactos'));
    }
    
    public function update(Request $request)
    {
    DB::table('Tipo_acto')->where('id_tipo_acto', $request->id_tipo_acto)->update([
        'Descripcion' => $request->modify_descripcion
    ]);

        $tipoactos = Tipo_acto::all();
        return view('menu-admin.adminTiposEvento', compact('tipoactos'));
    }
    
    public function destroy(Request $request)
    {
        $tipoactos = Tipo_acto::find($request->id_tipo_acto);
        $tipoactos->delete();

        $tipoactos = Tipo_acto::all();
        return view('menu-admin.adminTiposEvento', compact('tipoactos'));
    }
}
