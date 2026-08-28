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
        Schema::create('hoja_vidas', function (Blueprint $table) {
            // PK Identificador de la hoja de vida (BIGINT Auto-inc)
            $table->id('id_hoja_vida');

            // Fecha de ingreso a servicio en la empresa (DATE, Not Null)
            $table->date('fecha_ingreso');

            // Detalles eléctricos, voltaje, potencia y consumo (TEXT, Nullable)
            $table->text('especificaciones_tecnicas')->nullable();

            // FK Referencia a la máquina asociada (BIGINT, Not Null) -> maquinas.id_maquina
            $table->foreignId('id_maquina')
                  ->constrained('maquinas', 'id_maquina')
                  ->onDelete('cascade');

            // created_at (Fecha de registro inicial) y updated_at (Fecha de actualización)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoja_vidas');
    }
};