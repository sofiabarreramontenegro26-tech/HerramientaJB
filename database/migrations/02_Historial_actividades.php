<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_actividades', function (Blueprint $table) {
            $table->id('id_historial'); // BIGINT Auto-inc PK
            $table->text('accion'); // TEXT NOT NULL
            
            // BIGINT FK NOT NULL (usuarios.id_usuario)
            $table->foreignId('id_usuario')
                  ->constrained('usuarios', 'id_usuario')
                  ->onDelete('cascade');
                  
            $table->timestamps(); // created_at, updated_at TIMESTAMP NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_actividades');
    }
};