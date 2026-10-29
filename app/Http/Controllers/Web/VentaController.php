<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\StockInsuficienteException;
use App\Http\Requests\VentaRequest;
use App\Models\Cotizacion;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use App\Models\Venta;
use App\Services\FacturacionService;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VentaController extends Controller
{
    public function __construct(private readonly FacturacionService $facturacion)
    {
    }

    public function index(): View
    {
        return view('ventas.index', [
            'ventas' => Venta::with('usuario')->latest('fecha')->latest('id_venta')->paginate(15),
        ]);
    }

    /**
     * Si llega ?cotizacion=ID, el formulario se precarga con los productos de esa cotización.
     */
    public function create(Request $request): View
    {
        $itemsIniciales = [];

        if ($request->filled('cotizacion')) {
            $cotizacion = Cotizacion::find($request->integer('cotizacion'));

            $itemsIniciales = collect($cotizacion?->productos_seleccionados ?? [])
                ->map(fn ($linea) => ['id_producto' => $linea['id_producto'], 'cantidad' => $linea['cantidad']])
                ->all();
        }

        return view('ventas.create', [
            'productos' => Producto::orderBy('nombre')->get(),
            'itemsIniciales' => $itemsIniciales,
        ]);
    }

    public function store(VentaRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        try {
            $venta = $this->facturacion->registrarVenta(
                $datos['cliente'],
                $datos['fecha'],
                $datos['items'],
                $request->user()->id_usuario
            );
        } catch (StockInsuficienteException $e) {
            return back()->withInput()->withErrors(['items' => $e->getMessage()]);
        }

        RegistroActividad::registrar("Registró la venta #{$venta->id_venta} a \"{$venta->cliente}\"");

        return redirect()->route('ventas.show', $venta)->with('exito', 'Venta registrada y stock descontado.');
    }

    public function show(Venta $venta): View
    {
        $lineas = MovimientoInventario::with('producto')
            ->where('tipo', MovimientoInventario::SALIDA)
            ->where('motivo', $venta->motivoMovimiento())
            ->get();

        return view('ventas.show', [
            'venta' => $venta->load('usuario'),
            'lineas' => $lineas,
        ]);
    }
}
