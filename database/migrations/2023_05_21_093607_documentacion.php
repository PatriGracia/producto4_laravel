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

        Schema::create('Documentacion', function(Blueprint $table){
            
            $table->id('Id_presentacion');
            $table->unsignedBigInteger('Id_acto');
            $table->string('Localizacion_documentacion');
            $table->integer('Orden');
            $table->unsignedBigInteger('Id_persona');
            $table->string('Titulo_documento');
            $table->foreign('Id_acto')->references('Id_acto')->on('Actos');
            $table->foreign('Id_persona')->references('Id_persona')->on('Personas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Documentacion');
    }
};
