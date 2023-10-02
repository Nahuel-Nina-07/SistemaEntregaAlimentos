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
        Schema::create('detalles_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FacturaID');
            $table->unsignedBigInteger('DetalleCarritoID');
            $table->unsignedBigInteger('ProductoID');
            $table->integer('Cantidad');
            $table->decimal('PrecioUnitario', 10, 2);
            $table->foreign('FacturaID')->references('id')->on('facturas');
            $table->foreign('DetalleCarritoID')->references('id')->on('detalles_carrito');
            $table->foreign('ProductoID')->references('id')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_factura');
    }
};
