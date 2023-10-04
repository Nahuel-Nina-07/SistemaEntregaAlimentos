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
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('restaurante_id');
            $table->string('imagen')->nullable();
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias_productos');
            $table->foreign('restaurante_id')->references('id')->on('restaurantes');
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
