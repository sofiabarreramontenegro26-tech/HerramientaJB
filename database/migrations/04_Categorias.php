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
        Schema::create('categorias', function (Blueprint $table) {
            // id_categoria (Clave primaria autoincrementable BIGINT)
            $table->id('id_categoria');

            // nombre (VARCHAR 100, NOT NULL - RQF017, RQF018)
            $table->string('nombre', 100);

            // descripcion (TEXT, opcional / nullable)
            $table->text('descripcion')->nullable();

            // timestamps (created_at / updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};