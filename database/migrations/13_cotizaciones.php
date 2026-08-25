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
        Schema::create('cotizaciones', function (Blueprint $table) {
            // id_cotizacion (Clave primaria autoincrementable BIGINT)
            $table->id('id_cotizacion');

            // cliente_telefono (string, opcional / nullable)
            $table->string('cliente_telefono')->nullable();

            // productos_seleccionados (json - RQF019)
            $table->json('productos_seleccionados');

            // total (decimal, 10, 2)
            $table->decimal('total', 10, 2);

            // timestamps (created_at / updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};