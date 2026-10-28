<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProveedorRequest;
use App\Models\Proveedor;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProveedorController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');

        $proveedores = Proveedor::withCount(['productos', 'maquinas'])
            ->when($buscar, fn ($q) => $q->where(function ($sub) use ($buscar) {
                $sub->where('nombre', 'like', "%{$buscar}%")->orWhere('empresa', 'like', "%{$buscar}%");
            }))
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('proveedores.index', ['proveedores' => $proveedores]);
    }

    public function create(): View
    {
        return view('proveedores.form', ['proveedor' => new Proveedor()]);
    }

    public function store(ProveedorRequest $request): RedirectResponse
    {
        $proveedor = Proveedor::create($request->validated());

        RegistroActividad::registrar("Creó el proveedor \"{$proveedor->nombre}\"");

        return redirect()->route('proveedores.index')->with('exito', 'Proveedor creado.');
    }

    public function edit(Proveedor $proveedor): View
    {
        return view('proveedores.form', ['proveedor' => $proveedor]);
    }

    public function update(ProveedorRequest $request, Proveedor $proveedor): RedirectResponse
    {
        $proveedor->update($request->validated());

        RegistroActividad::registrar("Editó el proveedor \"{$proveedor->nombre}\"");

        return redirect()->route('proveedores.index')->with('exito', 'Proveedor actualizado.');
    }

    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        if ($proveedor->maquinas()->exists() || $proveedor->entradas()->exists()) {
            return back()->with('error', 'No puedes eliminar un proveedor con máquinas o entradas registradas.');
        }

        $proveedor->delete();

        RegistroActividad::registrar("Eliminó el proveedor \"{$proveedor->nombre}\"");

        return redirect()->route('proveedores.index')->with('exito', 'Proveedor eliminado.');
    }
}
