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
        Schema::create('registrar_restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('tipoNegocio');
            $table->string('NombreNegocio');
            $table->string('NumeroContacto');
            $table->string('CorreoNegocio');
            $table->string('nombrePropietario');
            $table->string('ApellidoPropietario');
            $table->string('CalleNegocio');
            $table->string('CiudadNegocio');
            $table->string('categoria');
            $table->string('LogoImg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrar_restaurantes');
    }
};
