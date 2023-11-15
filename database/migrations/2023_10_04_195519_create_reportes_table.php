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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('repartidor_id');
            $table->text('motivo');
            $table->dateTime('fecha_solicitud')->useCurrent(); 
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('repartidor_id')->references('id')->on('users');

            $table->unique(['user_id', 'repartidor_id']);
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
