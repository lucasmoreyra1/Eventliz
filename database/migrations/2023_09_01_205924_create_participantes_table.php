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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_evento');
            $table->foreign('id_evento')
                  ->references('id')
                  ->on('eventos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('nombre');
            $table->string('apellido');
            $table->bigInteger('telefono');
            $table->string('email');
            $table->boolean('asistencia')->default('0');
            $table->boolean('pago')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
