<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // 1. roles
        $roles = ['Administrador', 'Operario', 'Supervisor', 'Almacenista', 'Vendedor'];
        $idRoles = [];
        foreach ($roles as $nombre) {
            $idRoles[] = DB::table('roles')->insertGetId([
                'nombre' => $nombre,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 2. categorias
        $categorias = [
            ['nombre' => 'Herramientas Eléctricas', 'descripcion' => 'Herramientas de uso industrial'],
            ['nombre' => 'Ferretería', 'descripcion' => 'Insumos generales de ferretería'],
            ['nombre' => 'Seguridad Industrial', 'descripcion' => 'Equipos de protección personal'],
            ['nombre' => 'Plomería', 'descripcion' => 'Materiales para instalaciones hidráulicas'],
            ['nombre' => 'Electricidad', 'descripcion' => 'Materiales eléctricos y cableado'],
        ];
        $idCategorias = [];
        foreach ($categorias as $c) {
            $idCategorias[] = DB::table('categorias')->insertGetId(array_merge($c, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        // 3. proveedores
        $proveedores = [
            ['nombre' => 'Distribuidora ABC', 'telefono' => '3001234567', 'empresa' => 'ABC S.A.S'],
            ['nombre' => 'Ferretería El Tornillo', 'telefono' => '3012345678', 'empresa' => 'El Tornillo Ltda'],
            ['nombre' => 'Importadora Industrial', 'telefono' => '3023456789', 'empresa' => 'Imporindustrial S.A.'],
            ['nombre' => 'Suministros del Valle', 'telefono' => '3034567890', 'empresa' => 'SumiValle SAS'],
            ['nombre' => 'Herramientas y Más', 'telefono' => '3045678901', 'empresa' => 'H&M Comercial'],
        ];
        $idProveedores = [];
        foreach ($proveedores as $p) {
            $idProveedores[] = DB::table('proveedores')->insertGetId(array_merge($p, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        // 4. usuarios (depende de roles)
        $usuarios = [
            ['nombre_completo' => 'Laura Gómez', 'correo' => 'laura@sena.edu.co'],
            ['nombre_completo' => 'Carlos Ramírez', 'correo' => 'carlos@sena.edu.co'],
            ['nombre_completo' => 'Ana Martínez', 'correo' => 'ana@sena.edu.co'],
            ['nombre_completo' => 'Pedro Sánchez', 'correo' => 'pedro@sena.edu.co'],
            ['nombre_completo' => 'María Torres', 'correo' => 'maria@sena.edu.co'],
        ];
        $idUsuarios = [];
        foreach ($usuarios as $i => $u) {
            $idUsuarios[] = DB::table('usuarios')->insertGetId(array_merge($u, [
                'contraseña' => Hash::make('12345678'),
                'id_rol' => $idRoles[$i % count($idRoles)],
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        // 5. historial_actividades (depende de usuarios)
        $acciones = ['Inicio de sesión', 'Registró un producto', 'Actualizó inventario', 'Generó reporte', 'Cerró sesión'];
        foreach ($acciones as $i => $accion) {
            DB::table('historial_actividades')->insert([
                'accion' => $accion,
                'id_usuario' => $idUsuarios[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 6. productos (depende de categorias, proveedores)
        $productos = [
            ['nombre' => 'Taladro Percutor 1/2"', 'descripcion' => 'Taladro percutor industrial', 'marca' => 'DeWalt', 'precio_compra' => 150000, 'precio_venta' => 220000],
            ['nombre' => 'Juego de Llaves 12pz', 'descripcion' => 'Llaves combinadas cromadas', 'marca' => 'Stanley', 'precio_compra' => 60000, 'precio_venta' => 95000],
            ['nombre' => 'Casco de Seguridad', 'descripcion' => 'Casco industrial ajustable', 'marca' => '3M', 'precio_compra' => 25000, 'precio_venta' => 40000],
            ['nombre' => 'Tubo PVC 1/2 pulgada', 'descripcion' => 'Tubo para instalación hidráulica', 'marca' => 'Pavco', 'precio_compra' => 8000, 'precio_venta' => 13000],
            ['nombre' => 'Cable Eléctrico 12AWG', 'descripcion' => 'Rollo de cable por metro', 'marca' => 'Centelsa', 'precio_compra' => 3000, 'precio_venta' => 5000],
        ];
        $idProductos = [];
        foreach ($productos as $i => $p) {
            $idProductos[] = DB::table('productos')->insertGetId(array_merge($p, [
                'imagen' => null,
                'cantidad' => 50,
                'stock_minimo' => 10,
                'id_categoria' => $idCategorias[$i],
                'id_proveedor' => $idProveedores[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        // 7. entradas (depende de productos, proveedores)
        foreach ($idProductos as $i => $idProducto) {
            DB::table('entradas')->insert([
                'cantidad' => 50,
                'fecha' => $now,
                'id_producto' => $idProducto,
                'id_proveedor' => $idProveedores[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 8. movimiento_inventario (depende de productos)
        $tipos = ['ENTRADA', 'SALIDA', 'ENTRADA', 'SALIDA', 'ENTRADA'];
        foreach ($idProductos as $i => $idProducto) {
            DB::table('movimiento_inventario')->insert([
                'tipo' => $tipos[$i],
                'cantidad' => 10 + $i,
                'motivo' => $tipos[$i] === 'ENTRADA' ? 'Compra de stock' : 'Venta a cliente',
                'fecha' => $now,
                'id_producto' => $idProducto,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 9. configuracion_alertas (sin FK)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('configuracion_alertas')->insert([
                'dias_anticipacion_entrega' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 10. alertas_inventario (depende de productos)
        foreach ($idProductos as $idProducto) {
            DB::table('alertas_inventario')->insert([
                'id_producto' => $idProducto,
                'mensaje' => 'Stock por debajo del mínimo',
                'leido' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 11. catalogo_busquedas (depende de productos)
        foreach ($idProductos as $idProducto) {
            DB::table('catalogo_busquedas')->insert([
                'id_producto' => $idProducto,
                'destacado' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 12. productos_favoritos (depende de usuarios, productos)
        foreach ($idProductos as $i => $idProducto) {
            DB::table('productos_favoritos')->insert([
                'id_usuario' => $idUsuarios[$i],
                'id_producto' => $idProducto,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 13. cotizaciones (sin FK, campo json)
        for ($i = 0; $i < 5; $i++) {
            DB::table('cotizaciones')->insert([
                'cliente_telefono' => '310987654' . $i,
                'productos_seleccionados' => json_encode([
                    ['id_producto' => $idProductos[$i], 'cantidad' => $i + 1],
                ]),
                'total' => 100000 * ($i + 1),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 14. ventas (depende de usuarios)
        $clientes = ['Juan Pérez', 'Lucía Fernández', 'Andrés Gómez', 'Camila Ríos', 'Diego Morales'];
        foreach ($clientes as $i => $cliente) {
            DB::table('ventas')->insert([
                'cliente' => $cliente,
                'fecha' => $now,
                'total_venta' => 200000 + ($i * 10000),
                'ganancia_total' => 60000 + ($i * 5000),
                'id_usuario' => $idUsuarios[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 15. maquinas (depende de proveedores)
        $maquinas = [
            ['nombre' => 'Compresor Industrial', 'referencia' => 'COMP-2024-001'],
            ['nombre' => 'Soldadora Eléctrica', 'referencia' => 'SOLD-2024-002'],
            ['nombre' => 'Torno Mecánico', 'referencia' => 'TORN-2024-003'],
            ['nombre' => 'Sierra Circular', 'referencia' => 'SIER-2024-004'],
            ['nombre' => 'Pulidora Industrial', 'referencia' => 'PULI-2024-005'],
        ];
        $idMaquinas = [];
        foreach ($maquinas as $i => $m) {
            $idMaquinas[] = DB::table('maquinas')->insertGetId(array_merge($m, [
                'fecha_compra' => $now,
                'id_proveedor' => $idProveedores[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        // 16. hoja_vidas (depende de maquinas)
        foreach ($idMaquinas as $idMaquina) {
            DB::table('hoja_vidas')->insert([
                'fecha_ingreso' => $now,
                'especificaciones_tecnicas' => '220V, 2HP, 24L',
                'id_maquina' => $idMaquina,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 17. mantenimientos (depende de maquinas)
        $tecnicos = ['Carlos Ruiz', 'Luis Peña', 'Andrea López', 'Jorge Díaz', 'Sandra Vega'];
        $tiposMant = ['preventivo', 'correctivo', 'preventivo', 'correctivo', 'preventivo'];
        foreach ($idMaquinas as $i => $idMaquina) {
            DB::table('mantenimientos')->insert([
                'tipo_mantenimiento' => $tiposMant[$i],
                'descripcion' => 'Revisión general y ajustes',
                'fecha' => $now,
                'tecnico_responsable' => $tecnicos[$i],
                'id_maquina' => $idMaquina,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 18. registros_conectividad (sin FK)
        for ($i = 0; $i < 5; $i++) {
            DB::table('registros_conectividad')->insert([
                'estado_conexion' => $i % 2 === 0,
                'fecha_registro' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}