<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimiento_inventario', function (Blueprint $table) {
            $table->id('id_movimiento'); // Se recomienda PK explícita si usas id_producto
            $table->enum('tipo', ['ENTRADA', 'SALIDA']);
            $table->integer('cantidad');
            $table->string('motivo', 255)->nullable();
            $table->date('fecha');

            // FK a Producto
            $table->foreignId('id_producto')
                  ->constrained('productos', 'id_producto')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimiento_inventario');
    }
};