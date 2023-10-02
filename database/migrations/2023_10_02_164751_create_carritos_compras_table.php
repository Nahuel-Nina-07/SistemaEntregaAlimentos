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
        Schema::create('carritos_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ClienteID');
            $table->timestamp('FechaHoraCreacion')->default(now());
            $table->foreign('ClienteID')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos_compras');
    }
};
