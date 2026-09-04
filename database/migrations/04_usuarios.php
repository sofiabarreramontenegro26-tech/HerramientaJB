<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre_completo', 100);
            $table->string('correo', 100)->unique();
            $table->string('contraseña', 255);
            $table->foreignId('id_rol')->nullable()->constrained('roles', 'id_rol')->onDelete('set null'); // Llave foranea
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};