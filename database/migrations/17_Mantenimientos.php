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
        Schema::create('mantenimientos', function (Blueprint $table) {
            // PK Identificador del mantenimiento (BIGINT Auto-inc)
            $table->id('id_mantenimiento');

            // Categorización de la intervención (ENUM: preventivo, correctivo, Not Null)
            $table->enum('tipo_mantenimiento', ['preventivo', 'correctivo']);

            // Detalle de reparaciones, fallas encontradas y repuestos (TEXT, Not Null)
            $table->text('descripcion');

            // Fecha de ejecución del mantenimiento (DATE, Not Null)
            $table->date('fecha');

            // Nombre del profesional o técnico encargado (VARCHAR 100, Nullable)
            $table->string('tecnico_responsable', 100)->nullable();

            // FK Referencia a la máquina intervenida (BIGINT, Not Null) -> maquinas.id_maquina
            $table->foreignId('id_maquina')
                  ->constrained('maquinas', 'id_maquina')
                  ->onDelete('cascade');

            //created_at (Fecha y hora de guardado) y updated_at (Fecha de edición)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};