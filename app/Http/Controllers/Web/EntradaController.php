<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntradaRequest;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Services\InventarioService;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EntradaController extends Controller
{
    public function __construct(private readonly InventarioService $inventario)
    {
    }

    public function index(): View
    {
        return view('entradas.index', [
            'entradas' => Entrada::with(['producto', 'proveedor'])
                ->latest('fecha')
                ->latest('id_entrada')
                ->paginate(15),
        ]);
    }

    public function create(Request $request): View
    {
        return view('entradas.create', [
            'productos' => Producto::orderBy('nombre')->get(),
            'proveedores' => Proveedor::orderBy('nombre')->get(),
            'productoSeleccionado' => $request->integer('producto') ?: null,
        ]);
    }

    public function store(EntradaRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        $entrada = $this->inventario->registrarEntrada(
            (int) $datos['id_producto'],
            (int) $datos['id_proveedor'],
            (int) $datos['cantidad'],
            $datos['fecha']
        );

        RegistroActividad::registrar("Registró entrada de {$entrada->cantidad} unidad(es) de \"{$entrada->producto->nombre}\"");

        return redirect()->route('entradas.index')->with('exito', 'Entrada registrada y stock actualizado.');
    }
}
