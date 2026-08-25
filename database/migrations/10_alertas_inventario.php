<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('alertas_inventario', function (Blueprint $table) {
            // PK: id_alerta
            $table->id('id_alerta');

            // FK: id_producto foranea
            $table->foreignId('id_producto')
                  ->constrained('productos')
                  ->onDelete('cascade');

            // Mensaje de la alerta (RQF010, RQF015)
            $table->string('mensaje');

  
            $table->boolean('leido')->default(false);


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('alertas_inventario');
    }
};