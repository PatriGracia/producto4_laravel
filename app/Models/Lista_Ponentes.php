<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista_Ponentes extends Model
{
    use HasFactory;

    protected $table = "Lista_Ponentes";
    protected $primaryKey = 'id_ponente';
    public $timestamps = false;
}
