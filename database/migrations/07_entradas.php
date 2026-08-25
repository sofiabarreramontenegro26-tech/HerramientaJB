<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('entradas', function (Blueprint $table) {
            // PK: id_entrada 
            $table->id('id_entrada');

            $table->integer('cantidad');
            $table->date('fecha');

            // FK: id_producto
            $table->foreignId('id_producto')
                  ->constrained('productos', 'id_producto')
                  ->onDelete('cascade');

            // FK: id_proveedor 
            $table->foreignId('id_proveedor')
                  ->constrained('proveedores', 'id_proveedor')
                  ->onDelete('cascade');

            // created_at y updated_at (TIMESTAMP, Nulo)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};