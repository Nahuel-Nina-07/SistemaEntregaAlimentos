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
        Schema::create('detalles_carrito', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('CarritoID');
            $table->unsignedBigInteger('ProductoID');
            $table->integer('Cantidad');
            $table->foreign('CarritoID')->references('id')->on('carritos_compras');
            $table->foreign('ProductoID')->references('id')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_carrito');
    }
};
