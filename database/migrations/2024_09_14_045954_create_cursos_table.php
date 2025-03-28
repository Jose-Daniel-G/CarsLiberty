<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('horas_requeridas');
            $table->string('estado');
            // $table->string('ubicacion')->nullable();
            // $table->string('descripcion');
            // $table->string('capacidad');
            // $table->string('telefono')->nullable();
            // $table->string('especialidad');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
