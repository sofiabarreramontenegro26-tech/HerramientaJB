<?php

namespace App\Services;

use App\Exceptions\StockInsuficienteException;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class FacturacionService
{
    public function __construct(private readonly InventarioService $inventario)
    {
    }

    /**
     * Agrupa los ítems del formulario (mismo producto en varias filas se suma)
     * y calcula precios con los valores guardados en la base de datos,
     * nunca con valores enviados desde el navegador.
     *
     * @param  array<int, array{id_producto: int|string, cantidad: int|string}>  $items
     * @return array{detalle: array<int, array<string, mixed>>, total: float, ganancia: float}
     */
    public function calcular(array $items): array
    {
        $cantidades = [];

        foreach ($items as $item) {
            $id = (int) $item['id_producto'];
            $cantidades[$id] = ($cantidades[$id] ?? 0) + (int) $item['cantidad'];
        }

        $productos = Producto::whereIn('id_producto', array_keys($cantidades))->get()->keyBy('id_producto');

        $detalle = [];
        $total = 0.0;
        $ganancia = 0.0;

        foreach ($cantidades as $id => $cantidad) {
            $producto = $productos->get($id);

            if ($producto === null) {
                continue;
            }

            $precio = (float) $producto->precio_venta;
            $subtotal = round($precio * $cantidad, 2);

            $detalle[] = [
                'id_producto' => $producto->id_producto,
                'nombre' => $producto->nombre,
                'marca' => $producto->marca,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
            $ganancia += ($precio - (float) $producto->precio_compra) * $cantidad;
        }

        return [
            'detalle' => $detalle,
            'total' => round($total, 2),
            'ganancia' => round($ganancia, 2),
        ];
    }

    /**
     * Registra la venta y descuenta el inventario de cada producto en una sola transacción.
     * Si algún producto no alcanza, no se guarda nada.
     *
     * @throws StockInsuficienteException
     */
    public function registrarVenta(string $cliente, string $fecha, array $items, int $idUsuario): Venta
    {
        return DB::transaction(function () use ($cliente, $fecha, $items, $idUsuario) {
            $calculo = $this->calcular($items);

            $venta = Venta::create([
                'cliente' => $cliente,
                'fecha' => $fecha,
                'total_venta' => $calculo['total'],
                'ganancia_total' => $calculo['ganancia'],
                'id_usuario' => $idUsuario,
            ]);

            foreach ($calculo['detalle'] as $linea) {
                $this->inventario->registrarSalida(
                    $linea['id_producto'],
                    $linea['cantidad'],
                    $venta->motivoMovimiento(),
                    $fecha
                );
            }

            return $venta;
        });
    }
}
