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
        Schema::create('detalle_repartidor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repartidor_id');
            $table->dateTime('fecha_incorporacion');
            $table->integer('ci_numero')->nullable();
            $table->string('numero_placa')->nullable();
            $table->integer('edad')->nullable();
            $table->string('tipo_vehiculo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('imagen_propiedad_vehiculo')->nullable();
            $table->boolean('reportado')->default(false);
            $table->timestamps();

            $table->foreign('repartidor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_repartidor');
    }
};
