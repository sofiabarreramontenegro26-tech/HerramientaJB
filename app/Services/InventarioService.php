<?php

namespace App\Services;

use App\Exceptions\StockInsuficienteException;
use App\Models\AlertaInventario;
use App\Models\Entrada;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class InventarioService
{
    /**
     * Registra una compra a proveedor: crea la entrada, suma el stock
     * y deja el movimiento de trazabilidad.
     */
    public function registrarEntrada(int $idProducto, int $idProveedor, int $cantidad, string $fecha): Entrada
    {
        return DB::transaction(function () use ($idProducto, $idProveedor, $cantidad, $fecha) {
            $producto = Producto::lockForUpdate()->findOrFail($idProducto);

            $entrada = Entrada::create([
                'id_producto' => $producto->id_producto,
                'id_proveedor' => $idProveedor,
                'cantidad' => $cantidad,
                'fecha' => $fecha,
            ]);

            $producto->increment('cantidad', $cantidad);

            MovimientoInventario::create([
                'tipo' => MovimientoInventario::ENTRADA,
                'cantidad' => $cantidad,
                'motivo' => 'Entrada #' . $entrada->id_entrada . ' de proveedor',
                'fecha' => $fecha,
                'id_producto' => $producto->id_producto,
            ]);

            return $entrada;
        });
    }

    /**
     * Registra un movimiento de entrada sin proveedor (por ejemplo, el inventario inicial).
     */
    public function registrarAjusteEntrada(Producto $producto, int $cantidad, string $motivo, string $fecha): MovimientoInventario
    {
        return MovimientoInventario::create([
            'tipo' => MovimientoInventario::ENTRADA,
            'cantidad' => $cantidad,
            'motivo' => $motivo,
            'fecha' => $fecha,
            'id_producto' => $producto->id_producto,
        ]);
    }

    /**
     * Descuenta stock (uso en reparación, venta, daño, etc.).
     *
     * @throws StockInsuficienteException
     */
    public function registrarSalida(int $idProducto, int $cantidad, string $motivo, string $fecha): MovimientoInventario
    {
        return DB::transaction(function () use ($idProducto, $cantidad, $motivo, $fecha) {
            $producto = Producto::lockForUpdate()->findOrFail($idProducto);

            if ($producto->cantidad < $cantidad) {
                throw StockInsuficienteException::para($producto, $cantidad);
            }

            $producto->decrement('cantidad', $cantidad);

            $movimiento = MovimientoInventario::create([
                'tipo' => MovimientoInventario::SALIDA,
                'cantidad' => $cantidad,
                'motivo' => $motivo,
                'fecha' => $fecha,
                'id_producto' => $producto->id_producto,
            ]);

            $this->verificarStockMinimo($producto->refresh());

            return $movimiento;
        });
    }

    /**
     * Crea una alerta si el producto quedó en o por debajo del stock mínimo
     * y no existe ya una alerta sin leer para ese producto.
     */
    public function verificarStockMinimo(Producto $producto): void
    {
        if (! $producto->tieneStockBajo()) {
            return;
        }

        $yaExiste = AlertaInventario::noLeidas()
            ->where('id_producto', $producto->id_producto)
            ->exists();

        if ($yaExiste) {
            return;
        }

        AlertaInventario::create([
            'id_producto' => $producto->id_producto,
            'mensaje' => sprintf(
                'Stock bajo: "%s" tiene %d unidad(es) (mínimo %d).',
                $producto->nombre,
                $producto->cantidad,
                $producto->stock_minimo
            ),
            'leido' => false,
        ]);
    }
}
