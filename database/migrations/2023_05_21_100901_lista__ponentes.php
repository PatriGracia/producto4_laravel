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
`id_ponente` int NOT NULL,
  `Id_persona` int NOT NULL,
  `Id_acto` int NOT NULL,
  `Orden` int NOT NULL
        */

        Schema::create('Lista_Ponentes', function(Blueprint $table){
            
            $table->id('id_ponente');
            $table->unsignedBigInteger('Id_persona');
            $table->unsignedBigInteger('Id_acto');
            $table->integer('Orden');
            $table->foreign('Id_persona')->references('Id_persona')->on('Personas');
            $table->foreign('Id_acto')->references('Id_acto')->on('Actos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Lista_Ponentes');
    }
};
