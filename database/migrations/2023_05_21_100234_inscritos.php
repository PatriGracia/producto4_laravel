<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
 `Id_inscripcion` int NOT NULL,
  `Id_persona` int NOT NULL,
  `id_acto` int NOT NULL,
  `Fecha_inscripcion` datetime NOT NULL
        */
        Schema::create('Inscritos', function(Blueprint $table){
            
            $table->id('Id_inscripcion');
            $table->unsignedBigInteger('Id_persona');
            $table->unsignedBigInteger('id_acto');
            $table->dateTime('Fecha_inscripcion');
            $table->foreign('Id_persona')->references('Id_persona')->on('Personas');
            $table->foreign('id_acto')->references('Id_acto')->on('Actos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Inscritos');
    }
};
