<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CotizacionRequest;
use App\Models\Cotizacion;
use App\Models\Producto;
use App\Services\FacturacionService;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CotizacionController extends Controller
{
    public function __construct(private readonly FacturacionService $facturacion)
    {
    }

    public function index(): View
    {
        return view('cotizaciones.index', [
            'cotizaciones' => Cotizacion::latest('id_cotizacion')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('cotizaciones.create', [
            'productos' => Producto::orderBy('nombre')->get(),
        ]);
    }

    public function store(CotizacionRequest $request): RedirectResponse
    {
        $calculo = $this->facturacion->calcular($request->validated('items'));

        $cotizacion = Cotizacion::create([
            'cliente_telefono' => $request->validated('cliente_telefono'),
            'productos_seleccionados' => $calculo['detalle'],
            'total' => $calculo['total'],
        ]);

        RegistroActividad::registrar("Creó la cotización #{$cotizacion->id_cotizacion}");

        return redirect()->route('cotizaciones.show', $cotizacion)->with('exito', 'Cotización creada.');
    }

    public function show(Cotizacion $cotizacion): View
    {
        return view('cotizaciones.show', ['cotizacion' => $cotizacion]);
    }

    public function destroy(Cotizacion $cotizacion): RedirectResponse
    {
        $cotizacion->delete();

        RegistroActividad::registrar("Eliminó la cotización #{$cotizacion->id_cotizacion}");

        return redirect()->route('cotizaciones.index')->with('exito', 'Cotización eliminada.');
    }
}
