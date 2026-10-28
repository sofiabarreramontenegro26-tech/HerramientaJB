<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Services\InventarioService;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function __construct(private readonly InventarioService $inventario)
    {
    }

    public function index(Request $request): View
    {
        $productos = Producto::with(['categoria', 'proveedor'])
            ->buscar($request->query('buscar'))
            ->when($request->filled('categoria'), fn ($q) => $q->where('id_categoria', $request->integer('categoria')))
            ->when($request->boolean('stock_bajo'), fn ($q) => $q->stockBajo())
            ->orderBy('nombre')
            ->paginate(12)
            ->withQueryString();

        return view('productos.index', [
            'productos' => $productos,
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

    public function create(): View
    {
        return view('productos.form', $this->datosFormulario(new Producto(['stock_minimo' => 5, 'cantidad' => 0])));
    }

    public function store(ProductoRequest $request): RedirectResponse
    {
        $datos = $request->safe()->except('imagen');

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = DB::transaction(function () use ($datos) {
            $producto = Producto::create($datos);

            if ($producto->cantidad > 0) {
                $this->inventario->registrarAjusteEntrada($producto, $producto->cantidad, 'Inventario inicial', now()->toDateString());
            }

            $this->inventario->verificarStockMinimo($producto);

            return $producto;
        });

        RegistroActividad::registrar("Creó el producto \"{$producto->nombre}\"");

        return redirect()->route('productos.index')->with('exito', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto): View
    {
        return view('productos.form', $this->datosFormulario($producto));
    }

    public function update(ProductoRequest $request, Producto $producto): RedirectResponse
    {
        $datos = $request->safe()->except('imagen');

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);
        $this->inventario->verificarStockMinimo($producto);

        RegistroActividad::registrar("Editó el producto \"{$producto->nombre}\"");

        return redirect()->route('productos.index')->with('exito', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto): RedirectResponse
    {
        $producto->delete();

        RegistroActividad::registrar("Eliminó el producto \"{$producto->nombre}\"");

        return redirect()->route('productos.index')->with('exito', 'Producto eliminado.');
    }

    private function datosFormulario(Producto $producto): array
    {
        return [
            'producto' => $producto,
            'categorias' => Categoria::orderBy('nombre')->get(),
            'proveedores' => Proveedor::orderBy('nombre')->get(),
        ];
    }
}
