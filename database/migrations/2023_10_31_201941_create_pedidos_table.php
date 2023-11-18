<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('repartidor_id_aceptado')->nullable();
            $table->dateTime('fecha_hora_pedido');
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7); 
            $table->string('estado', 250)->default('Pendiente');
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('repartidor_id_aceptado')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
