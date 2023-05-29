<?php

namespace App\Http\Controllers;

use App\Models\Tipo_acto;
use Illuminate\Http\Request;

class Tipo_actoController extends Controller
{
    public static function getTipo_acto(){
        $tipos = Tipo_acto::all();
        return $tipos;
    }
}
