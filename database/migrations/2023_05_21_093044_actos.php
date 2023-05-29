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

        Schema::create('Actos', function(Blueprint $table){
            
            $table->id('Id_acto');
            $table->date('Fecha');
            $table->time('Hora');
            $table->string('Titulo');
            $table->string('Descripcion_corta');
            $table->text('Descripcion_larga');
            $table->integer('Num_asistentes');
            $table->unsignedBigInteger('Id_tipo_acto');
            $table->foreign('Id_tipo_acto')->references('Id_tipo_acto')->on('Tipo_acto');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Actos');
    }
};
