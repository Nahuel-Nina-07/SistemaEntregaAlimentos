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
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_incorporacion');
            $table->string('nombre');
            $table->unsignedBigInteger('categoria_id');
            $table->string('telefono')->nullable();
            $table->string('CalleNegocio');
            $table->string('CiudadNegocio');
            $table->string('correo_electronico')->nullable();
            $table->string('imagen')->nullable();
            $table->string('nombrePropietario');
            $table->string('ApellidoPropietario');
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias_restaurantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
