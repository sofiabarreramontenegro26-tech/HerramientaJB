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
        Schema::create('configuracion_alertas', function (Blueprint $table) {
            // PK: BIGINT Auto-inc (id_configuracion)
            $table->id('id_configuracion');

            // INT, NOT NULL, Default 2
            $table->integer('dias_anticipacion_entrega')->default(2);

            // created_at y updated_at (TIMESTAMP, NULLABLE por defecto en Laravel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_alertas');
    }
};