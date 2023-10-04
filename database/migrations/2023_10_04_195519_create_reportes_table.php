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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repartidor_id');
            $table->text('motivo_reporte');
            $table->dateTime('fecha_reporte');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('repartidor_id')->references('id')->on('detalle_repartidor');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
