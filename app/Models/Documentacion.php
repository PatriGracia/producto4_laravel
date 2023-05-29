<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    use HasFactory;

    protected $table = "Documentacion";
    protected $primaryKey = 'Id_presentacion';
    public $timestamps = false;
}
