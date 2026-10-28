<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Datos de ejemplo de HerramientaJB.
 *
 * Todo es coherente entre sí:
 *  - El stock de cada producto = lo comprado (entradas) - salidas a reparaciones - ventas.
 *  - Cada entrada, salida y venta deja su registro en movimiento_inventario.
 *  - Solo hay alertas para los productos que quedaron en o por debajo del stock mínimo.
 *  - Las cotizaciones guardan el detalle completo (nombre, precio, subtotal).
 *
 * Ejecutar (BORRA todos los datos y vuelve a crear las tablas):
 *   php artisan migrate:fresh --seed
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $this->sembrar();
        });
    }

    private function sembrar(): void
    {
        $ahora = now();
        $marcas = fn ($fecha = null) => ['created_at' => $fecha ?? $ahora, 'updated_at' => $fecha ?? $ahora];

        /* ------------------------------------------------------------------
         | 1. Roles (Administrador y Técnico) + usuario admin@herramientajb.com
         * ------------------------------------------------------------------ */
        $this->call(RolesYAdministradorSeeder::class);

        $idAdministrador = Rol::where('nombre', 'Administrador')->value('id_rol');
        $idTecnico = Rol::where('nombre', 'Técnico')->value('id_rol');

        /* ------------------------------------------------------------------
         | 2. Usuarios de ejemplo (contraseña de todos: 12345678)
         * ------------------------------------------------------------------ */
        $usuarios = [
            ['nombre_completo' => 'Laura Gómez', 'correo' => 'laura@sena.edu.co', 'id_rol' => $idAdministrador],
            ['nombre_completo' => 'Carlos Ramírez', 'correo' => 'carlos@sena.edu.co', 'id_rol' => $idTecnico],
            ['nombre_completo' => 'Ana Martínez', 'correo' => 'ana@sena.edu.co', 'id_rol' => $idTecnico],
            ['nombre_completo' => 'Pedro Sánchez', 'correo' => 'pedro@sena.edu.co', 'id_rol' => $idTecnico],
            ['nombre_completo' => 'María Torres', 'correo' => 'maria@sena.edu.co', 'id_rol' => $idTecnico],
        ];

        $idUsuarios = [];
        foreach ($usuarios as $u) {
            $idUsuarios[] = DB::table('usuarios')->insertGetId($u + [
                'contraseña' => Hash::make('12345678'),
            ] + $marcas());
        }
        [$laura, $carlos, $ana, $pedro, $maria] = $idUsuarios;

        /* ------------------------------------------------------------------
         | 3. Categorías
         * ------------------------------------------------------------------ */
        $categorias = [
            'herramientas' => ['nombre' => 'Herramientas Eléctricas', 'descripcion' => 'Herramientas de uso industrial'],
            'ferreteria' => ['nombre' => 'Ferretería', 'descripcion' => 'Insumos generales de ferretería'],
            'seguridad' => ['nombre' => 'Seguridad Industrial', 'descripcion' => 'Equipos de protección personal'],
            'plomeria' => ['nombre' => 'Plomería', 'descripcion' => 'Materiales para instalaciones hidráulicas'],
            'electricidad' => ['nombre' => 'Electricidad', 'descripcion' => 'Materiales eléctricos y cableado'],
            'motores' => ['nombre' => 'Repuestos de Motores', 'descripcion' => 'Rodamientos, escobillas y piezas de bobinado'],
        ];

        $idCategoria = [];
        foreach ($categorias as $clave => $c) {
            $idCategoria[$clave] = DB::table('categorias')->insertGetId($c + $marcas());
        }

        /* ------------------------------------------------------------------
         | 4. Proveedores
         * ------------------------------------------------------------------ */
        $proveedores = [
            'abc' => ['nombre' => 'Distribuidora ABC', 'telefono' => '3001234567', 'empresa' => 'ABC S.A.S'],
            'tornillo' => ['nombre' => 'Ferretería El Tornillo', 'telefono' => '3012345678', 'empresa' => 'El Tornillo Ltda'],
            'importadora' => ['nombre' => 'Importadora Industrial', 'telefono' => '3023456789', 'empresa' => 'Imporindustrial S.A.'],
            'valle' => ['nombre' => 'Suministros del Valle', 'telefono' => '3034567890', 'empresa' => 'SumiValle SAS'],
            'hym' => ['nombre' => 'Herramientas y Más', 'telefono' => '3045678901', 'empresa' => 'H&M Comercial'],
        ];

        $idProveedor = [];
        foreach ($proveedores as $clave => $p) {
            $idProveedor[$clave] = DB::table('proveedores')->insertGetId($p + $marcas());
        }

        /* ------------------------------------------------------------------
         | 5. Productos
         |    'comprado' = unidades que entraron por compra a proveedor.
         |    El stock final se calcula más abajo con las salidas y ventas.
         * ------------------------------------------------------------------ */
        $productos = [
            'taladro' => ['nombre' => 'Taladro Percutor 1/2"', 'descripcion' => 'Taladro percutor industrial 800 W', 'marca' => 'DeWalt', 'compra' => 150000, 'venta' => 220000, 'minimo' => 3, 'comprado' => 12, 'cat' => 'herramientas', 'prov' => 'hym'],
            'llaves' => ['nombre' => 'Juego de Llaves 12pz', 'descripcion' => 'Llaves combinadas cromadas', 'marca' => 'Stanley', 'compra' => 60000, 'venta' => 95000, 'minimo' => 3, 'comprado' => 8, 'cat' => 'ferreteria', 'prov' => 'tornillo'],
            'casco' => ['nombre' => 'Casco de Seguridad', 'descripcion' => 'Casco industrial ajustable', 'marca' => '3M', 'compra' => 25000, 'venta' => 40000, 'minimo' => 5, 'comprado' => 20, 'cat' => 'seguridad', 'prov' => 'abc'],
            'tubo' => ['nombre' => 'Tubo PVC 1/2 pulgada', 'descripcion' => 'Tubo para instalación hidráulica (6 m)', 'marca' => 'Pavco', 'compra' => 8000, 'venta' => 13000, 'minimo' => 10, 'comprado' => 40, 'cat' => 'plomeria', 'prov' => 'valle'],
            'cable' => ['nombre' => 'Cable Eléctrico 12AWG (metro)', 'descripcion' => 'Cable de cobre THHN por metro', 'marca' => 'Centelsa', 'compra' => 3000, 'venta' => 5000, 'minimo' => 50, 'comprado' => 200, 'cat' => 'electricidad', 'prov' => 'abc'],
            'rodamiento' => ['nombre' => 'Rodamiento 6205 ZZ', 'descripcion' => 'Rodamiento rígido de bolas para motores', 'marca' => 'SKF', 'compra' => 18000, 'venta' => 28000, 'minimo' => 6, 'comprado' => 10, 'cat' => 'motores', 'prov' => 'importadora'],
            'escobillas' => ['nombre' => 'Escobillas de carbón 6x10', 'descripcion' => 'Par de escobillas para taladros y pulidoras', 'marca' => 'Bosch', 'compra' => 4000, 'venta' => 7500, 'minimo' => 5, 'comprado' => 6, 'cat' => 'motores', 'prov' => 'importadora'],
            'condensador' => ['nombre' => 'Condensador 30µF 450V', 'descripcion' => 'Condensador de marcha para motores monofásicos', 'marca' => 'Ducati', 'compra' => 12000, 'venta' => 21000, 'minimo' => 4, 'comprado' => 15, 'cat' => 'electricidad', 'prov' => 'valle'],
        ];

        $idProducto = [];
        $stock = [];
        foreach ($productos as $clave => $p) {
            $idProducto[$clave] = DB::table('productos')->insertGetId([
                'nombre' => $p['nombre'],
                'descripcion' => $p['descripcion'],
                'marca' => $p['marca'],
                'imagen' => null,
                'cantidad' => 0,
                'stock_minimo' => $p['minimo'],
                'precio_compra' => $p['compra'],
                'precio_venta' => $p['venta'],
                'id_categoria' => $idCategoria[$p['cat']],
                'id_proveedor' => $idProveedor[$p['prov']],
            ] + $marcas());
            $stock[$clave] = 0;
        }

        $movimiento = function (string $tipo, string $producto, int $cantidad, string $motivo, $fecha) use (&$stock, $idProducto, $marcas) {
            DB::table('movimiento_inventario')->insert([
                'tipo' => $tipo,
                'cantidad' => $cantidad,
                'motivo' => $motivo,
                'fecha' => $fecha->toDateString(),
                'id_producto' => $idProducto[$producto],
            ] + $marcas($fecha));

            $stock[$producto] += $tipo === 'ENTRADA' ? $cantidad : -$cantidad;
        };

        /* ------------------------------------------------------------------
         | 6. Entradas (compras a proveedor) - hace 25 días
         * ------------------------------------------------------------------ */
        $fechaCompra = $ahora->copy()->subDays(25);
        foreach ($productos as $clave => $p) {
            $idEntrada = DB::table('entradas')->insertGetId([
                'cantidad' => $p['comprado'],
                'fecha' => $fechaCompra->toDateString(),
                'id_producto' => $idProducto[$clave],
                'id_proveedor' => $idProveedor[$p['prov']],
            ] + $marcas($fechaCompra));

            $movimiento('ENTRADA', $clave, $p['comprado'], "Entrada #{$idEntrada} de proveedor", $fechaCompra);
        }

        /* ------------------------------------------------------------------
         | 7. Salidas de repuestos usados en reparaciones
         * ------------------------------------------------------------------ */
        $movimiento('SALIDA', 'rodamiento', 4, 'Uso en reparación: Compresor Industrial COMP-2024-001', $ahora->copy()->subDays(12));
        $movimiento('SALIDA', 'rodamiento', 2, 'Uso en reparación: Torno Mecánico TORN-2024-003', $ahora->copy()->subDays(6));
        $movimiento('SALIDA', 'escobillas', 5, 'Uso en reparación: Pulidora Industrial PULI-2024-005', $ahora->copy()->subDays(4));
        $movimiento('SALIDA', 'cable', 160, 'Uso en reparación: rebobinado de motor trifásico', $ahora->copy()->subDays(9));
        $movimiento('SALIDA', 'condensador', 3, 'Uso en mantenimiento preventivo', $ahora->copy()->subDays(3));

        /* ------------------------------------------------------------------
         | 8. Ventas (descuentan stock con motivo "Venta #ID")
         * ------------------------------------------------------------------ */
        $ventas = [
            ['cliente' => 'Juan Pérez', 'dias' => 15, 'usuario' => $laura, 'items' => ['taladro' => 2, 'casco' => 1]],
            ['cliente' => 'Lucía Fernández', 'dias' => 11, 'usuario' => $laura, 'items' => ['llaves' => 1, 'cable' => 20]],
            ['cliente' => 'Andrés Gómez', 'dias' => 8, 'usuario' => $laura, 'items' => ['condensador' => 2, 'casco' => 3]],
            ['cliente' => 'Camila Ríos', 'dias' => 5, 'usuario' => $laura, 'items' => ['tubo' => 15]],
            ['cliente' => 'Diego Morales', 'dias' => 2, 'usuario' => $laura, 'items' => ['taladro' => 1, 'llaves' => 6]],
        ];

        foreach ($ventas as $v) {
            $fecha = $ahora->copy()->subDays($v['dias']);
            $total = 0;
            $ganancia = 0;

            foreach ($v['items'] as $clave => $cantidad) {
                $total += $productos[$clave]['venta'] * $cantidad;
                $ganancia += ($productos[$clave]['venta'] - $productos[$clave]['compra']) * $cantidad;
            }

            $idVenta = DB::table('ventas')->insertGetId([
                'cliente' => $v['cliente'],
                'fecha' => $fecha->toDateString(),
                'total_venta' => $total,
                'ganancia_total' => $ganancia,
                'id_usuario' => $v['usuario'],
            ] + $marcas($fecha));

            foreach ($v['items'] as $clave => $cantidad) {
                $movimiento('SALIDA', $clave, $cantidad, "Venta #{$idVenta}", $fecha);
            }
        }

        /* ------------------------------------------------------------------
         | 9. Stock final y alertas (solo para los que quedaron bajos)
         * ------------------------------------------------------------------ */
        foreach ($productos as $clave => $p) {
            DB::table('productos')->where('id_producto', $idProducto[$clave])->update(['cantidad' => $stock[$clave]]);

            if ($stock[$clave] <= $p['minimo']) {
                DB::table('alertas_inventario')->insert([
                    'id_producto' => $idProducto[$clave],
                    'mensaje' => sprintf('Stock bajo: "%s" tiene %d unidad(es) (mínimo %d).', $p['nombre'], $stock[$clave], $p['minimo']),
                    'leido' => false,
                ] + $marcas());
            }
        }

        /* ------------------------------------------------------------------
         | 10. Cotizaciones (con el detalle completo que necesita la vista)
         * ------------------------------------------------------------------ */
        $cotizaciones = [
            ['telefono' => '3109876540', 'dias' => 10, 'items' => ['rodamiento' => 4, 'escobillas' => 2]],
            ['telefono' => '3109876541', 'dias' => 7, 'items' => ['taladro' => 1, 'casco' => 2]],
            ['telefono' => '3109876542', 'dias' => 3, 'items' => ['cable' => 30, 'condensador' => 1]],
            ['telefono' => null, 'dias' => 1, 'items' => ['llaves' => 1]],
        ];

        foreach ($cotizaciones as $c) {
            $detalle = [];
            $total = 0;

            foreach ($c['items'] as $clave => $cantidad) {
                $subtotal = $productos[$clave]['venta'] * $cantidad;
                $detalle[] = [
                    'id_producto' => $idProducto[$clave],
                    'nombre' => $productos[$clave]['nombre'],
                    'marca' => $productos[$clave]['marca'],
                    'cantidad' => $cantidad,
                    'precio_unitario' => $productos[$clave]['venta'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }

            DB::table('cotizaciones')->insert([
                'cliente_telefono' => $c['telefono'],
                'productos_seleccionados' => json_encode($detalle, JSON_UNESCAPED_UNICODE),
                'total' => $total,
            ] + $marcas($ahora->copy()->subDays($c['dias'])));
        }

        /* ------------------------------------------------------------------
         | 11. Máquinas, hojas de vida y mantenimientos
         * ------------------------------------------------------------------ */
        $maquinas = [
            ['nombre' => 'Compresor Industrial', 'referencia' => 'COMP-2024-001', 'prov' => 'abc', 'compra' => 400, 'specs' => "Voltaje: 220 V\nPotencia: 3 HP\nTanque: 100 L\nPresión máx.: 150 PSI"],
            ['nombre' => 'Soldadora Eléctrica', 'referencia' => 'SOLD-2024-002', 'prov' => 'tornillo', 'compra' => 320, 'specs' => "Voltaje: 220 V\nCorriente: 250 A\nCiclo de trabajo: 60 %"],
            ['nombre' => 'Torno Mecánico', 'referencia' => 'TORN-2024-003', 'prov' => 'importadora', 'compra' => 700, 'specs' => "Voltaje: 220 V trifásico\nPotencia: 5 HP\nDistancia entre puntos: 1000 mm"],
            ['nombre' => 'Sierra Circular', 'referencia' => 'SIER-2024-004', 'prov' => 'valle', 'compra' => 210, 'specs' => "Voltaje: 120 V\nPotencia: 1800 W\nDisco: 7 1/4\""],
            ['nombre' => 'Pulidora Industrial', 'referencia' => 'PULI-2024-005', 'prov' => 'hym', 'compra' => 150, 'specs' => "Voltaje: 120 V\nPotencia: 2200 W\nDisco: 9\"\nRPM: 6600"],
        ];

        $mantenimientos = [
            'COMP-2024-001' => [
                ['tipo' => 'preventivo', 'dias' => 40, 'tecnico' => 'Carlos Ramírez', 'desc' => 'Cambio de aceite del cabezal, limpieza de filtro de aire y purga del tanque.'],
                ['tipo' => 'correctivo', 'dias' => 12, 'tecnico' => 'Carlos Ramírez', 'desc' => 'Ruido excesivo en el motor. Se reemplazaron 4 rodamientos 6205 ZZ y se ajustó la correa.'],
            ],
            'SOLD-2024-002' => [
                ['tipo' => 'preventivo', 'dias' => 20, 'tecnico' => 'Ana Martínez', 'desc' => 'Revisión de cables y pinza porta-electrodo. Limpieza interna con aire comprimido.'],
            ],
            'TORN-2024-003' => [
                ['tipo' => 'correctivo', 'dias' => 6, 'tecnico' => 'Pedro Sánchez', 'desc' => 'Vibración en el husillo. Cambio de 2 rodamientos y alineación del cabezal.'],
            ],
            'SIER-2024-004' => [
                ['tipo' => 'preventivo', 'dias' => 2, 'tecnico' => 'María Torres', 'desc' => 'Cambio de disco, lubricación de guía y verificación del freno del motor.'],
            ],
            'PULI-2024-005' => [
                ['tipo' => 'correctivo', 'dias' => 4, 'tecnico' => 'Carlos Ramírez', 'desc' => 'No encendía. Escobillas desgastadas: se reemplazaron 5 pares y se limpió el colector.'],
            ],
        ];

        foreach ($maquinas as $m) {
            $fechaCompraMaquina = $ahora->copy()->subDays($m['compra']);

            $idMaquina = DB::table('maquinas')->insertGetId([
                'nombre' => $m['nombre'],
                'referencia' => $m['referencia'],
                'fecha_compra' => $fechaCompraMaquina->toDateString(),
                'id_proveedor' => $idProveedor[$m['prov']],
            ] + $marcas());

            DB::table('hoja_vidas')->insert([
                'fecha_ingreso' => $fechaCompraMaquina->copy()->addDays(7)->toDateString(),
                'especificaciones_tecnicas' => $m['specs'],
                'id_maquina' => $idMaquina,
            ] + $marcas());

            foreach ($mantenimientos[$m['referencia']] as $mt) {
                $fecha = $ahora->copy()->subDays($mt['dias']);
                DB::table('mantenimientos')->insert([
                    'tipo_mantenimiento' => $mt['tipo'],
                    'descripcion' => $mt['desc'],
                    'fecha' => $fecha->toDateString(),
                    'tecnico_responsable' => $mt['tecnico'],
                    'id_maquina' => $idMaquina,
                ] + $marcas($fecha));
            }
        }

        /* ------------------------------------------------------------------
         | 12. Historial de actividades
         * ------------------------------------------------------------------ */
        $acciones = [
            [$laura, 'Inició sesión', 25],
            [$laura, 'Registró entradas de mercancía de 8 productos', 25],
            [$carlos, 'Registró mantenimiento correctivo en "Compresor Industrial"', 12],
            [$laura, 'Registró la venta #1 a "Juan Pérez"', 15],
            [$pedro, 'Registró mantenimiento correctivo en "Torno Mecánico"', 6],
            [$carlos, 'Registró mantenimiento correctivo en "Pulidora Industrial"', 4],
            [$maria, 'Registró mantenimiento preventivo en "Sierra Circular"', 2],
            [$ana, 'Actualizó la hoja de vida de "Soldadora Eléctrica"', 1],
        ];

        foreach ($acciones as [$usuario, $accion, $dias]) {
            DB::table('historial_actividades')->insert([
                'accion' => $accion,
                'id_usuario' => $usuario,
            ] + $marcas($ahora->copy()->subDays($dias)));
        }

        /* ------------------------------------------------------------------
         | 13. Tablas que usa la API (no aparecen en las pantallas)
         * ------------------------------------------------------------------ */
        DB::table('configuracion_alertas')->insert(['dias_anticipacion_entrega' => 2] + $marcas());

        foreach (['taladro', 'rodamiento', 'condensador'] as $clave) {
            DB::table('catalogo_busquedas')->insert(['id_producto' => $idProducto[$clave], 'destacado' => true] + $marcas());
        }

        foreach ([[$carlos, 'rodamiento'], [$ana, 'escobillas'], [$pedro, 'condensador']] as [$usuario, $clave]) {
            DB::table('productos_favoritos')->insert(['id_usuario' => $usuario, 'id_producto' => $idProducto[$clave]] + $marcas());
        }

        for ($i = 0; $i < 5; $i++) {
            $fecha = $ahora->copy()->subHours($i * 6);
            DB::table('registros_conectividad')->insert([
                'estado_conexion' => $i !== 2,
                'fecha_registro' => $fecha,
            ] + $marcas($fecha));
        }
    }
}
