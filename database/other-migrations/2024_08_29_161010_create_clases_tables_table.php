<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('profesor_id');
            $table->unsignedBigInteger('vehiculo_id')->nullable();
            $table->unsignedBigInteger('curso_id'); // Asegúrate de que esta columna sea un unsignedBigInteger
            $table->dateTime('fecha_hora');
            $table->integer('duracion'); // En minutos
            $table->string('estado');
            $table->timestamps();

            // Relaciones
            $table->foreign('alumno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('set null');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade'); // Asegúrate de que `cursos.id` sea unsignedBigInteger
        });
    }

    public function down()
    {
        Schema::dropIfExists('clases');
    }
};
