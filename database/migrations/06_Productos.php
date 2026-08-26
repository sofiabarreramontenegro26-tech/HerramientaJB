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
        Schema::create('productos', function (Blueprint $table) {
            // id_producto (BIGINT, Auto-inc, PK - Identificador único del producto)
            $table->id('id_producto');

            // nombre (VARCHAR 100, NOT NULL - Nombre comercial o referencia)
            $table->string('nombre', 100);

            // descripcion (TEXT, opcional / nullable - Descripción de características)
            $table->text('descripcion')->nullable();

            // marca (VARCHAR 100, opcional / nullable - Marca o fabricante)
            $table->string('marca', 100)->nullable();

            // imagen (VARCHAR 255, opcional / nullable - Ruta o URL de la imagen)
            $table->string('imagen', 255)->nullable();

            // cantidad (INT, NOT NULL, Default 0 - Unidades disponibles en stock)
            $table->integer('cantidad')->default(0);

            // stock_minimo (INT, NOT NULL, Default 5 - Umbral para alertas)
            $table->integer('stock_minimo')->default(5);

            // precio_compra (DECIMAL 10,2, NOT NULL - Costo de adquisición)
            $table->decimal('precio_compra', 10, 2);

            // precio_venta (DECIMAL 10,2, NOT NULL - Precio final al cliente)
            $table->decimal('precio_venta', 10, 2);

            // id_categoria (BIGINT, FK -> categorias.id_categoria)
            $table->foreignId('id_categoria')
                  ->constrained('categorias', 'id_categoria')
                  ->onDelete('cascade');

            // id_proveedor (BIGINT, opcional / FK -> proveedores.id_proveedor)
            $table->foreignId('id_proveedor')
                  ->nullable()
                  ->constrained('proveedores', 'id_proveedor')
                  ->nullOnDelete();

            // timestamps (created_at / updated_at - Fecha de registro y actualización)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};