<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'Personas';

    protected $primaryKey = 'Id_Persona';
    public $timestamps = false;

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'Id_persona', 'Id_Persona');
    }
}
