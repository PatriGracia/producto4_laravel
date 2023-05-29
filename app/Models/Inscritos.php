<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscritos extends Model
{
    use HasFactory;

    protected $table = "Inscritos";
    protected $primaryKey = 'Id_inscripcion';
    public $timestamps = false;
}
