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
        Schema::create('registros_conectividad', function (Blueprint $table) {
            // PK Identificador del estado de conexión (BIGINT Auto-inc)
            $table->id('id_conectividad');

            // Estado del enlace (True = En línea, False = Desconectado) (BOOLEAN, Not Null)
            $table->boolean('estado_conexion');

            // Momento exacto del chequeo de conectividad (TIMESTAMP, Not Null)
            $table->timestamp('fecha_registro');

            // Timestamps: created_at (Fecha de creación) y updated_at (Fecha de actualización)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_conectividad');
    }
};