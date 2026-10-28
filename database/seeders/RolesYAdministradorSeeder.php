<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesYAdministradorSeeder extends Seeder
{
    /**
     * Crea los dos roles del sistema (Administrador y Técnico),
     * elimina el rol Recepcionista si existía y crea un administrador inicial.
     *
     * Ejecutar con: php artisan db:seed --class=RolesYAdministradorSeeder
     */
    public function run(): void
    {
        Rol::where('nombre', 'Recepcionista')->delete();

        $administrador = Rol::firstOrCreate(['nombre' => 'Administrador']);
        Rol::firstOrCreate(['nombre' => 'Técnico']);

        Usuario::firstOrCreate(
            ['correo' => 'admin@herramientajb.com'],
            [
                'nombre_completo' => 'Administrador HerramientaJB',
                'contraseña' => Hash::make('Admin12345'),
                'id_rol' => $administrador->id_rol,
            ]
        );
    }
}
