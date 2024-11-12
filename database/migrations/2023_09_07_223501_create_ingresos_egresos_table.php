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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_evento');
            $table->foreign('id_evento')
                  ->references('id')
                  ->on('eventos')
                  ->ondDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('fecha');
            $table->char('tipo', 1)->default("I"); // Ingreso, Egreso 
            $table->string('descripcion');
            $table->double('monto', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_egresos');
    }
};
