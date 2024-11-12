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
        Schema::disableForeignKeyConstraints();
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_cliente');
            $table->integer('id_tipo');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('organizador')->nullable();
            $table->integer('id_menu');
            $table->integer('id_locacion');
            $table->string('requisitos')->nullable();
            $table->string('web')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_final')->nullable();
            $table->time('hora_inicio');
            $table->time('hora_final')->nullable();
            $table->double('costo_organizacion', 15, 2)->default(0.0);
            $table->integer('cant_participantes');
            $table->double('costo_participante', 15, 2)->default(0.0);
            $table->double('presupuesto_evento', 15, 2)->default(0.0);
            $table->char('estado', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
