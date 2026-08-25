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
        Schema::create('maquinas', function (Blueprint $table) {
            // PK Identificador único de la máquina (BIGINT Auto-inc)
            $table->id('id_maquina');

            // Nombre de la máquina eléctrica o equipo (VARCHAR 100, Not Null)
            $table->string('nombre', 100);

            // Código o número de serie/referencia de fábrica (VARCHAR 100, UNIQUE, Not Null)
            $table->string('referencia', 100)->unique();

            // Fecha de adquisición del equipo (DATE, Not Null)
            $table->date('fecha_compra');

            // FK Proveedor o empresa suministradora (BIGINT, Not Null) -> proveedores.id_proveedor
            $table->foreignId('id_proveedor')
                  ->constrained('proveedores', 'id_proveedor')
                  ->onDelete('cascade');

            // Timestamps: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinas');
    }
};