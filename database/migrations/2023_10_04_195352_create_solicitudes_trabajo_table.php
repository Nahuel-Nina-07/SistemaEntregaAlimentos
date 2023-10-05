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
        Schema::create('solicitudes_trabajo', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_solicitud');
            $table->string('nombre_solicitante');
            $table->string('apellido_solicitante');
            $table->string('correo_electronico_solicitante');
            $table->string('telefono_solicitante');
            $table->boolean('edad')->default(true);
            $table->boolean('vehiculoPropio')->default(true);
            $table->string('tipo_vehiculo')->nullable();
            $table->string('imagen_propiedad_vehiculo')->nullable();
            $table->integer('ci_numero')->nullable();
            $table->boolean('estadoSolicitud')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_trabajo');
    }
};
