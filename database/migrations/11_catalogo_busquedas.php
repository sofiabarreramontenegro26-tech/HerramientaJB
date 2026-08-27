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
        Schema::create('catalogo_busquedas', function (Blueprint $table) {
            // PK: BIGINT Auto-inc (id_catalogo)
            $table->id('id_catalogo');

            // FK: BIGINT NOT NULL (id_producto)
            $table->unsignedBigInteger('id_producto');

            // BOOLEAN, NOT NULL, Default false
            $table->boolean('destacado')->default(false);

            // created_at y updated_at (TIMESTAMP, NULLABLE)
            $table->timestamps();

            // Definición de la Clave Foránea (FK) relacionando la tabla productos
            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_busquedas');
    }
};