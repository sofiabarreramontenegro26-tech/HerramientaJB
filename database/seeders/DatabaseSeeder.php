<?php

namespace Database\Seeders;

use App\Models\AlertaInventario;
use App\Models\CatalogoBusqueda;
use App\Models\Categoria;
use App\Models\ConfiguracionAlerta;
use App\Models\Cotizacion;
use App\Models\Entrada;
use App\Models\HistorialActividad;
use App\Models\HojaVida;
use App\Models\Mantenimiento;
use App\Models\Maquina;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use App\Models\ProductoFavorito;
use App\Models\Proveedor;
use App\Models\RegistroConectividad;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->roles();
        $this->categorias();
        $this->proveedores();
        $this->usuarios();
        $this->productos();
        $this->configuracionAlertas();
        $this->entradas();
        $this->movimientoInventario();
        $this->alertasInventario();
        $this->catalogoBusquedas();
        $this->productosFavoritos();
        $this->cotizaciones();
        $this->ventas();
        $this->maquinas();
        $this->hojasVida();
        $this->mantenimientos();
        $this->registrosConectividad();
        $this->historialActividades();
    }

    protected function roles(): void
    {
        foreach (['Administrador', 'Almacén', 'Ventas'] as $nombre) {
            Rol::firstOrCreate(['nombre' => $nombre]);
        }
    }

    protected function categorias(): void
    {
        $categorias = [
            ['nombre' => 'Herramientas manuales', 'descripcion' => 'Herramientas para trabajo general y mantenimiento.'],
            ['nombre' => 'Electricidad', 'descripcion' => 'Materiales y accesorios eléctricos.'],
            ['nombre' => 'Seguridad', 'descripcion' => 'Elementos de protección personal y seguridad industrial.'],
            ['nombre' => 'Ferretería', 'descripcion' => 'Productos básicos de ferretería y construcción.'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['nombre' => $categoria['nombre']],
                ['descripcion' => $categoria['descripcion']]
            );
        }
    }

    protected function proveedores(): void
    {
        $proveedores = [
            ['nombre' => 'Javier Torres', 'telefono' => '3001234567', 'empresa' => 'JTB Soluciones'],
            ['nombre' => 'Mónica Ríos', 'telefono' => '3017654321', 'empresa' => 'FerreMax LTDA'],
            ['nombre' => 'Andrés Díaz', 'telefono' => '3029876543', 'empresa' => 'Insumos Industriales'],
            ['nombre' => 'Constructora Siglo XXI', 'telefono' => '3104567890', 'empresa' => 'Siglo XXI'],
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::firstOrCreate(
                ['nombre' => $proveedor['nombre']],
                ['telefono' => $proveedor['telefono'], 'empresa' => $proveedor['empresa']]
            );
        }
    }

    protected function usuarios(): void
    {
        $adminRolId = Rol::where('nombre', 'Administrador')->value('id_rol');
        $almacenRolId = Rol::where('nombre', 'Almacén')->value('id_rol');
        $ventasRolId = Rol::where('nombre', 'Ventas')->value('id_rol');

        $usuarios = [
            ['nombre_completo' => 'Administrador Principal', 'correo' => 'admin@jtb.com', 'id_rol' => $adminRolId],
            ['nombre_completo' => 'Ana García', 'correo' => 'almacen@jtb.com', 'id_rol' => $almacenRolId],
            ['nombre_completo' => 'Carlos López', 'correo' => 'ventas@jtb.com', 'id_rol' => $ventasRolId],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::firstOrCreate(
                ['correo' => $usuario['correo']],
                [
                    'nombre_completo' => $usuario['nombre_completo'],
                    'contraseña' => Hash::make('password123'),
                    'id_rol' => $usuario['id_rol'],
                ]
            );
        }
    }

    protected function productos(): void
    {
        $categoriaHerramientas = Categoria::where('nombre', 'Herramientas manuales')->value('id_categoria');
        $categoriaElectricidad = Categoria::where('nombre', 'Electricidad')->value('id_categoria');
        $categoriaSeguridad = Categoria::where('nombre', 'Seguridad')->value('id_categoria');
        $categoriaFerreteria = Categoria::where('nombre', 'Ferretería')->value('id_categoria');

        $proveedor1 = Proveedor::where('nombre', 'Javier Torres')->value('id_proveedor');
        $proveedor2 = Proveedor::where('nombre', 'Mónica Ríos')->value('id_proveedor');
        $proveedor3 = Proveedor::where('nombre', 'Andrés Díaz')->value('id_proveedor');

        $productos = [
            ['nombre' => 'Taladro Inalámbrico 18V', 'descripcion' => 'Taladro con batería recargable y dos velocidades.', 'marca' => 'Makita', 'imagen' => 'productos/taladro.jpg', 'cantidad' => 15, 'stock_minimo' => 5, 'precio_compra' => 230000.00, 'precio_venta' => 320000.00, 'id_categoria' => $categoriaHerramientas, 'id_proveedor' => $proveedor1],
            ['nombre' => 'Llave Inglesa 12 pulgadas', 'descripcion' => 'Llave ajustable de alta resistencia para mantenimiento.', 'marca' => 'Truper', 'imagen' => 'productos/llave.jpg', 'cantidad' => 30, 'stock_minimo' => 8, 'precio_compra' => 55000.00, 'precio_venta' => 85000.00, 'id_categoria' => $categoriaHerramientas, 'id_proveedor' => $proveedor2],
            ['nombre' => 'Cable Eléctrico 2.5mm', 'descripcion' => 'Cable de cobre flexible para instalaciones internas.', 'marca' => 'Elektra', 'imagen' => 'productos/cable.jpg', 'cantidad' => 40, 'stock_minimo' => 10, 'precio_compra' => 18000.00, 'precio_venta' => 26000.00, 'id_categoria' => $categoriaElectricidad, 'id_proveedor' => $proveedor3],
            ['nombre' => 'Guantes de Seguridad', 'descripcion' => 'Guantes resistentes para manipulación de materiales.', 'marca' => 'SafePro', 'imagen' => 'productos/guantes.jpg', 'cantidad' => 50, 'stock_minimo' => 12, 'precio_compra' => 14000.00, 'precio_venta' => 22000.00, 'id_categoria' => $categoriaSeguridad, 'id_proveedor' => $proveedor2],
            ['nombre' => 'Tornillos Hexagonales', 'descripcion' => 'Paquete de tornillos para uso general y armado.', 'marca' => 'JTB', 'imagen' => 'productos/tornillos.jpg', 'cantidad' => 100, 'stock_minimo' => 25, 'precio_compra' => 12000.00, 'precio_venta' => 18000.00, 'id_categoria' => $categoriaFerreteria, 'id_proveedor' => $proveedor1],
            ['nombre' => 'Cinta Aislante Premium', 'descripcion' => 'Cinta aislante para cableado y mantenimiento eléctrico.', 'marca' => 'IsolMax', 'imagen' => 'productos/cinta.jpg', 'cantidad' => 60, 'stock_minimo' => 15, 'precio_compra' => 9000.00, 'precio_venta' => 15000.00, 'id_categoria' => $categoriaElectricidad, 'id_proveedor' => $proveedor3],
        ];

        foreach ($productos as $producto) {
            Producto::firstOrCreate(
                ['nombre' => $producto['nombre']],
                [
                    'descripcion' => $producto['descripcion'],
                    'marca' => $producto['marca'],
                    'imagen' => $producto['imagen'],
                    'cantidad' => $producto['cantidad'],
                    'stock_minimo' => $producto['stock_minimo'],
                    'precio_compra' => $producto['precio_compra'],
                    'precio_venta' => $producto['precio_venta'],
                    'id_categoria' => $producto['id_categoria'],
                    'id_proveedor' => $producto['id_proveedor'],
                ]
            );
        }
    }

    protected function configuracionAlertas(): void
    {
        ConfiguracionAlerta::firstOrCreate(
            ['id_configuracion' => 1],
            ['dias_anticipacion_entrega' => 2]
        );
    }

    protected function entradas(): void
    {
        $producto1 = Producto::where('nombre', 'Taladro Inalámbrico 18V')->value('id_producto');
        $producto2 = Producto::where('nombre', 'Cable Eléctrico 2.5mm')->value('id_producto');
        $proveedor1 = Proveedor::where('nombre', 'Javier Torres')->value('id_proveedor');
        $proveedor3 = Proveedor::where('nombre', 'Andrés Díaz')->value('id_proveedor');

        $entradas = [
            ['cantidad' => 10, 'fecha' => '2026-09-01', 'id_producto' => $producto1, 'id_proveedor' => $proveedor1],
            ['cantidad' => 20, 'fecha' => '2026-09-06', 'id_producto' => $producto2, 'id_proveedor' => $proveedor3],
        ];

        foreach ($entradas as $entrada) {
            Entrada::firstOrCreate(
                ['cantidad' => $entrada['cantidad'], 'fecha' => $entrada['fecha'], 'id_producto' => $entrada['id_producto'], 'id_proveedor' => $entrada['id_proveedor']],
                $entrada
            );
        }
    }

    protected function movimientoInventario(): void
    {
        if (!DB::table('movimiento_inventario')->exists()) {
            DB::table('movimiento_inventario')->insert([
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    protected function alertasInventario(): void
    {
        $producto = Producto::where('nombre', 'Guantes de Seguridad')->value('id_producto');

        if ($producto) {
            AlertaInventario::firstOrCreate(
                ['id_producto' => $producto],
                ['mensaje' => 'Stock bajo: guantes de seguridad cerca del mínimo.', 'leido' => false]
            );
        }
    }

    protected function catalogoBusquedas(): void
    {
        $producto = Producto::where('nombre', 'Taladro Inalámbrico 18V')->value('id_producto');

        if ($producto) {
            CatalogoBusqueda::firstOrCreate(
                ['id_producto' => $producto],
                ['destacado' => true]
            );
        }
    }

    protected function productosFavoritos(): void
    {
        $usuario = Usuario::where('correo', 'ventas@jtb.com')->value('id_usuario');
        $producto = Producto::where('nombre', 'Cable Eléctrico 2.5mm')->value('id_producto');

        if ($usuario && $producto) {
            ProductoFavorito::firstOrCreate(
                ['id_usuario' => $usuario, 'id_producto' => $producto],
                ['id_usuario' => $usuario, 'id_producto' => $producto]
            );
        }
    }

    protected function cotizaciones(): void
    {
        Cotizacion::firstOrCreate(
            ['cliente_telefono' => '3005550123'],
            [
                'productos_seleccionados' => [
                    ['id_producto' => 1, 'cantidad' => 2],
                    ['id_producto' => 3, 'cantidad' => 1],
                ],
                'total' => 560000.00,
            ]
        );
    }

    protected function ventas(): void
    {
        $usuario = Usuario::where('correo', 'ventas@jtb.com')->value('id_usuario');

        if ($usuario) {
            Venta::firstOrCreate(
                ['cliente' => 'Constructora Zeta', 'fecha' => '2026-09-10', 'id_usuario' => $usuario],
                ['total_venta' => 320000.00, 'ganancia_total' => 90000.00]
            );
        }
    }

    protected function maquinas(): void
    {
        $proveedor = Proveedor::where('nombre', 'Constructora Siglo XXI')->value('id_proveedor');

        if ($proveedor) {
            Maquina::firstOrCreate(
                ['referencia' => 'MAQ-1001'],
                ['nombre' => 'Compresora industrial', 'fecha_compra' => '2024-05-12', 'id_proveedor' => $proveedor]
            );

            Maquina::firstOrCreate(
                ['referencia' => 'MAQ-1002'],
                ['nombre' => 'Sierra circular', 'fecha_compra' => '2025-02-20', 'id_proveedor' => $proveedor]
            );
        }
    }

    protected function hojasVida(): void
    {
        $maquina = Maquina::where('referencia', 'MAQ-1001')->value('id_maquina');

        if ($maquina) {
            HojaVida::firstOrCreate(
                ['id_maquina' => $maquina],
                ['fecha_ingreso' => '2024-05-15', 'especificaciones_tecnicas' => 'Motor 5 HP, 220V, mantenimiento trimestral.']
            );
        }
    }

    protected function mantenimientos(): void
    {
        $maquina = Maquina::where('referencia', 'MAQ-1001')->value('id_maquina');

        if ($maquina) {
            Mantenimiento::firstOrCreate(
                ['tipo_mantenimiento' => 'preventivo', 'fecha' => '2026-08-15', 'id_maquina' => $maquina],
                ['descripcion' => 'Cambio de filtros, revisión de correas y ajuste de presión.', 'tecnico_responsable' => 'Luis Moreno']
            );
        }
    }

    protected function registrosConectividad(): void
    {
        RegistroConectividad::firstOrCreate(
            ['fecha_registro' => '2026-09-15 08:00:00'],
            ['estado_conexion' => true]
        );
    }

    protected function historialActividades(): void
    {
        $usuario = Usuario::where('correo', 'admin@jtb.com')->value('id_usuario');

        if ($usuario) {
            HistorialActividad::firstOrCreate(
                ['accion' => 'Se inicializó el sistema con datos base', 'id_usuario' => $usuario],
                ['accion' => 'Se inicializó el sistema con datos base', 'id_usuario' => $usuario]
            );
        }
    }
}
