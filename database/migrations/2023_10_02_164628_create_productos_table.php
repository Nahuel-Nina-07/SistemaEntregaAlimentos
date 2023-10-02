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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('NombreProducto');
            $table->text('Descripcion');
            $table->decimal('Precio', 10, 2);
            $table->integer('Stock');
            $table->string('Imagen');
            $table->unsignedBigInteger('RestauranteID');
            $table->unsignedBigInteger('CategoriaID');
            $table->foreign('RestauranteID')->references('id')->on('restaurantes');
            $table->foreign('CategoriaID')->references('id')->on('categorias_productos');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
