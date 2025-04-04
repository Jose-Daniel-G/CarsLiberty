<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->string('modelo');
            $table->boolean('disponible')->default(true);
            $table->string('tipo');
            $table->timestamps();
            $table->unsignedBigInteger('profesor_id')->nullable();
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('vehiculos_tables');
    }
};
