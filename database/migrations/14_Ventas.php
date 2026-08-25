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
        Schema::create('ventas', function (Blueprint $table) {
            // PK Identificador único de la venta
            $table->id('id_venta');

            // cliente (string - RQF021)
            $table->string('cliente');

            // fecha (date - RQF021)
            $table->date('fecha');

            // total_venta (decimal 10,2 - RQF021)
            $table->decimal('total_venta', 10, 2);

            // ganancia_total (decimal 10,2 - RQF023)
            $table->decimal('ganancia_total', 10, 2);

            // FK a la tabla usuarios
            $table->foreignId('id_usuario')
                  ->constrained('usuarios', 'id_usuario')
                  ->onDelete('cascade');

            // timestamps (created_at / updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};