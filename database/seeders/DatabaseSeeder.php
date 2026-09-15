<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Entrada;
use App\Models\MovimientoInventario;
use App\Models\ConfiguracionAlerta;
use App\Models\AlertaInventario;
use App\Models\CatalogoBusqueda;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $administradorId = DB::table('roles')->insertGetId([
                'nombre' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $vendedorId = DB::table('roles')->insertGetId([
                'nombre' => 'Vendedor',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $almacenistaId = DB::table('roles')->insertGetId([
                'nombre' => 'Almacenista',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $computadoresId = DB::table('categorias')->insertGetId([
                'nombre' => 'Computadores',
                'descripcion' => 'Computadores de escritorio y portátiles.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $perifericosId = DB::table('categorias')->insertGetId([
                'nombre' => 'Periféricos',
                'descripcion' => 'Teclados, mouse, cámaras y otros periféricos.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $monitoresId = DB::table('categorias')->insertGetId([
                'nombre' => 'Monitores',
                'descripcion' => 'Monitores para oficina, diseño y entretenimiento.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $almacenamientoId = DB::table('categorias')->insertGetId([
                'nombre' => 'Almacenamiento',
                'descripcion' => 'Discos SSD, discos duros y memorias USB.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $accesoriosId = DB::table('categorias')->insertGetId([
                'nombre' => 'Accesorios',
                'descripcion' => 'Cables, adaptadores y otros accesorios tecnológicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $tecnologiaGlobalId = DB::table('proveedores')->insertGetId([
                'nombre' => 'Tecnología Global',
                'telefono' => '3001234567',
                'empresa' => 'Tecnología Global S.A.S.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $compuDistribucionesId = DB::table('proveedores')->insertGetId([
                'nombre' => 'CompuDistribuciones',
                'telefono' => '3109876543',
                'empresa' => 'CompuDistribuciones S.A.S.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $digitalSolutionsId = DB::table('proveedores')->insertGetId([
                'nombre' => 'Digital Solutions',
                'telefono' => '3154567890',
                'empresa' => 'Digital Solutions Colombia S.A.S.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $importadoraTechId = DB::table('proveedores')->insertGetId([
                'nombre' => 'Importadora Tech',
                'telefono' => '3207654321',
                'empresa' => 'Importadora Tech S.A.S.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $administradorUsuarioId = DB::table('usuarios')->insertGetId([
                'nombre_completo' => 'Carlos Administrador',
                'correo' => 'admin@inventario.com',
                'contraseña' => Hash::make('Admin123*'),
                'id_rol' => $administradorId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $vendedorUsuarioId = DB::table('usuarios')->insertGetId([
                'nombre_completo' => 'María Vendedora',
                'correo' => 'maria@inventario.com',
                'contraseña' => Hash::make('Vendedor123*'),
                'id_rol' => $vendedorId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $almacenistaUsuarioId = DB::table('usuarios')->insertGetId([
                'nombre_completo' => 'Juan Almacenista',
                'correo' => 'juan@inventario.com',
                'contraseña' => Hash::make('Almacenista123*'),
                'id_rol' => $almacenistaId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $productos = [
                [
                    'nombre' => 'Portátil IdeaPad 3',
                    'descripcion' => 'Computador portátil para trabajo y estudio.',
                    'marca' => 'Lenovo',
                    'imagen' => null,
                    'cantidad' => 15,
                    'stock_minimo' => 5,
                    'precio_compra' => 1800000,
                    'precio_venta' => 2250000,
                    'id_categoria' => $computadoresId,
                    'id_proveedor' => $tecnologiaGlobalId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'Mouse Inalámbrico M185',
                    'descripcion' => 'Mouse inalámbrico compacto para oficina.',
                    'marca' => 'Logitech',
                    'imagen' => null,
                    'cantidad' => 40,
                    'stock_minimo' => 10,
                    'precio_compra' => 45000,
                    'precio_venta' => 65000,
                    'id_categoria' => $perifericosId,
                    'id_proveedor' => $compuDistribucionesId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'Teclado Mecánico K552',
                    'descripcion' => 'Teclado mecánico con iluminación RGB.',
                    'marca' => 'Redragon',
                    'imagen' => null,
                    'cantidad' => 25,
                    'stock_minimo' => 5,
                    'precio_compra' => 140000,
                    'precio_venta' => 195000,
                    'id_categoria' => $perifericosId,
                    'id_proveedor' => $digitalSolutionsId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'Monitor 24 Pulgadas',
                    'descripcion' => 'Monitor Full HD de 24 pulgadas.',
                    'marca' => 'Samsung',
                    'imagen' => null,
                    'cantidad' => 12,
                    'stock_minimo' => 4,
                    'precio_compra' => 520000,
                    'precio_venta' => 680000,
                    'id_categoria' => $monitoresId,
                    'id_proveedor' => $tecnologiaGlobalId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'SSD 1TB NVMe',
                    'descripcion' => 'Unidad de almacenamiento SSD NVMe de 1TB.',
                    'marca' => 'Kingston',
                    'imagen' => null,
                    'cantidad' => 20,
                    'stock_minimo' => 5,
                    'precio_compra' => 280000,
                    'precio_venta' => 360000,
                    'id_categoria' => $almacenamientoId,
                    'id_proveedor' => $importadoraTechId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'Memoria USB 64GB',
                    'descripcion' => 'Memoria USB de 64GB.',
                    'marca' => 'SanDisk',
                    'imagen' => null,
                    'cantidad' => 50,
                    'stock_minimo' => 10,
                    'precio_compra' => 25000,
                    'precio_venta' => 40000,
                    'id_categoria' => $almacenamientoId,
                    'id_proveedor' => $compuDistribucionesId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'Cable HDMI 2 Metros',
                    'descripcion' => 'Cable HDMI de alta velocidad de 2 metros.',
                    'marca' => 'UGREEN',
                    'imagen' => null,
                    'cantidad' => 35,
                    'stock_minimo' => 10,
                    'precio_compra' => 30000,
                    'precio_venta' => 45000,
                    'id_categoria' => $accesoriosId,
                    'id_proveedor' => $digitalSolutionsId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'Base Refrigerante para Portátil',
                    'descripcion' => 'Base con ventiladores para refrigeración de portátil.',
                    'marca' => 'Cooler Master',
                    'imagen' => null,
                    'cantidad' => 18,
                    'stock_minimo' => 5,
                    'precio_compra' => 85000,
                    'precio_venta' => 120000,
                    'id_categoria' => $accesoriosId,
                    'id_proveedor' => $importadoraTechId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            $productoIds = [];

            foreach ($productos as $producto) {
                $productoIds[] = DB::table('productos')->insertGetId($producto);
            }

            DB::table('historial_actividades')->insert([
                [
                    'accion' => 'Inicio de sesión en el sistema.',
                    'id_usuario' => $administradorUsuarioId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'accion' => 'Registro de nuevos productos.',
                    'id_usuario' => $administradorUsuarioId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'accion' => 'Consulta del inventario.',
                    'id_usuario' => $vendedorUsuarioId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'accion' => 'Consulta de productos disponibles.',
                    'id_usuario' => $vendedorUsuarioId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'accion' => 'Actualización de cantidades del inventario.',
                    'id_usuario' => $almacenistaUsuarioId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'accion' => 'Consulta de productos con stock bajo.',
                    'id_usuario' => $almacenistaUsuarioId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('productos_favoritos')->insert([
                [
                    'id_usuario' => $administradorUsuarioId,
                    'id_producto' => $productoIds[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_usuario' => $administradorUsuarioId,
                    'id_producto' => $productoIds[3],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_usuario' => $vendedorUsuarioId,
                    'id_producto' => $productoIds[4],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            $clienteUnoId = DB::table('clientes')->insertGetId([
                'nombre' => 'Andrea Gómez',
                'telefono' => '3001112233',
                'correo' => 'andrea@cliente.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $clienteDosId = DB::table('clientes')->insertGetId([
                'nombre' => 'Felipe Ramírez',
                'telefono' => '3114445566',
                'correo' => 'felipe@cliente.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('cotizaciones')->insert([
                [
                    'id_cliente' => $clienteUnoId,
                    'monto_total' => 150000.00,
                    'estado' => 'Pendiente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_cliente' => $clienteDosId,
                    'monto_total' => 320000.50,
                    'estado' => 'Aprobada',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('ventas')->insert([
                [
                    'id_cliente' => $clienteUnoId,
                    'total' => 150000.00,
                    'metodo_pago' => 'Efectivo',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_cliente' => $clienteDosId,
                    'total' => 320000.50,
                    'metodo_pago' => 'Transferencia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            $tornoId = DB::table('maquinas')->insertGetId([
                'nombre' => 'Torno Electromecánico CNC',
                'modelo' => 'X200',
                'estado' => 'Operativa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $prensaId = DB::table('maquinas')->insertGetId([
                'nombre' => 'Prensa Hidráulica 20T',
                'modelo' => 'PH-20',
                'estado' => 'En Mantenimiento',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('hojas_vida')->insert([
                [
                    'id_maquina' => $tornoId,
                    'descripcion' => 'Hoja de vida para seguimiento de motor principal y rodamientos.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_maquina' => $prensaId,
                    'descripcion' => 'Hoja de vida para revisión del sistema hidráulico y pistones.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('mantenimientos')->insert([
                [
                    'id_maquina' => $tornoId,
                    'tipo_mantenimiento' => 'Preventivo',
                    'observaciones' => 'Cambio de aceite y calibración de motor.',
                    'fecha_mantenimiento' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_maquina' => $prensaId,
                    'tipo_mantenimiento' => 'Correctivo',
                    'observaciones' => 'Reparación de fuga en manguera de presión.',
                    'fecha_mantenimiento' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('registros_conectividad')->insert([
                [
                    'estado_conexion' => true,
                    'fecha_registro' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'estado_conexion' => false,
                    'fecha_registro' => now()->subMinutes(15),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            Entrada::create([
                'cantidad' => 10,
                'fecha' => '2026-09-01',
                'id_producto' => $productoIds[0],
                'id_proveedor' => $tecnologiaGlobalId,
            ]);

            Entrada::create([
                'cantidad' => 20,
                'fecha' => '2026-09-05',
                'id_producto' => $productoIds[1],
                'id_proveedor' => $compuDistribucionesId,
            ]);

            Entrada::create([
                'cantidad' => 15,
                'fecha' => '2026-09-10',
                'id_producto' => $productoIds[2],
                'id_proveedor' => $digitalSolutionsId,
            ]);

            MovimientoInventario::create([]);
            MovimientoInventario::create([]);
            MovimientoInventario::create([]);

            ConfiguracionAlerta::create([
                'dias_anticipacion_entrega' => 2,
            ]);

            ConfiguracionAlerta::create([
                'dias_anticipacion_entrega' => 5,
            ]);

            ConfiguracionAlerta::create([
                'dias_anticipacion_entrega' => 7,
            ]);

            AlertaInventario::create([
                'id_producto' => $productoIds[0],
                'mensaje' => 'El producto está próximo a agotarse.',
                'leido' => false,
            ]);

            AlertaInventario::create([
                'id_producto' => $productoIds[1],
                'mensaje' => 'El nivel de inventario es bajo.',
                'leido' => false,
            ]);

            AlertaInventario::create([
                'id_producto' => $productoIds[2],
                'mensaje' => 'Se recomienda realizar una nueva entrada de producto.',
                'leido' => true,
            ]);

            CatalogoBusqueda::create([
                'id_producto' => $productoIds[0],
                'destacado' => true,
            ]);

            CatalogoBusqueda::create([
                'id_producto' => $productoIds[1],
                'destacado' => false,
            ]);

            CatalogoBusqueda::create([
                'id_producto' => $productoIds[2],
                'destacado' => true,
            ]);
        });
    }
}