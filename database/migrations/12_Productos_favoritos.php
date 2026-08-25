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
        Schema::create('productos_favoritos', function (Blueprint $table) {
            // PK Identificador del producto favorito (BIGINT Auto-inc)
            $table->id('id_favorito');

            // FK Referencia al usuario cliente (opcional / nullable)
            $table->foreignId('id_usuario')
                  ->nullable()
                  ->constrained('usuarios', 'id_usuario')
                  ->nullOnDelete();

            // FK Referencia al producto marcado como favorito (requerido / Not Null)
            $table->foreignId('id_producto')
                  ->constrained('productos', 'id_producto')
                  ->onDelete('cascade');

            // Timestamps: created_at (Fecha de marcado) y updated_at (Fecha de modificación)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_favoritos');
    }
};