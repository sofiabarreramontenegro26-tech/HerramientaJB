<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\StockInsuficienteException;
use App\Http\Requests\SalidaRequest;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use App\Services\InventarioService;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovimientoController extends Controller
{
    public function __construct(private readonly InventarioService $inventario)
    {
    }

    public function index(Request $request): View
    {
        $tipo = $request->query('tipo');

        $movimientos = MovimientoInventario::with('producto')
            ->when(in_array($tipo, [MovimientoInventario::ENTRADA, MovimientoInventario::SALIDA], true), fn ($q) => $q->where('tipo', $tipo))
            ->latest('fecha')
            ->latest('id_movimiento')
            ->paginate(20)
            ->withQueryString();

        return view('movimientos.index', ['movimientos' => $movimientos]);
    }

    public function create(Request $request): View
    {
        return view('movimientos.create', [
            'productos' => Producto::where('cantidad', '>', 0)->orderBy('nombre')->get(),
            'productoSeleccionado' => $request->integer('producto') ?: null,
        ]);
    }

    public function store(SalidaRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        try {
            $movimiento = $this->inventario->registrarSalida(
                (int) $datos['id_producto'],
                (int) $datos['cantidad'],
                $datos['motivo'],
                $datos['fecha']
            );
        } catch (StockInsuficienteException $e) {
            return back()->withInput()->withErrors(['cantidad' => $e->getMessage()]);
        }

        RegistroActividad::registrar("Registró salida de {$movimiento->cantidad} unidad(es) de \"{$movimiento->producto->nombre}\"");

        return redirect()->route('movimientos.index')->with('exito', 'Salida registrada y stock actualizado.');
    }
}
