<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    use HasFactory;

    protected $table = 'Documentacion';

    protected $fillable = [
        'Id_presentacion', 'Id_acto', 'Localizacion_documentacion', 'Orden', 'Id_persona', 'Titulo_documento'
    ];
}
