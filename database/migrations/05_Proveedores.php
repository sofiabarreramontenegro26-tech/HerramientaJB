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
        Schema::create('proveedores', function (Blueprint $table) {
            // id_proveedor (BIGINT, Auto-inc, PK - Identificador único del proveedor)
            $table->id('id_proveedor');

            // nombre (VARCHAR 100, NOT NULL - Nombre comercial o razón social)
            $table->string('nombre', 100);

            // telefono (VARCHAR 20, opcional / nullable - Número telefónico o celular)
            $table->string('telefono', 20)->nullable();

            // empresa (VARCHAR 100, opcional / nullable - Nombre formal de la compañía)
            $table->string('empresa', 100)->nullable();

            // timestamps (created_at / updated_at - Fechas de registro y actualización)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};