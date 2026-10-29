<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaquinaRequest;
use App\Models\Maquina;
use App\Models\Proveedor;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaquinaController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');

        $maquinas = Maquina::with(['proveedor', 'ultimoMantenimiento'])
            ->withCount('mantenimientos')
            ->when($buscar, fn ($q) => $q->where(function ($sub) use ($buscar) {
                $sub->where('nombre', 'like', "%{$buscar}%")->orWhere('referencia', 'like', "%{$buscar}%");
            }))
            ->orderBy('nombre')
            ->paginate(12)
            ->withQueryString();

        return view('maquinas.index', ['maquinas' => $maquinas]);
    }

    public function create(): View
    {
        return view('maquinas.form', [
            'maquina' => new Maquina(),
            'proveedores' => Proveedor::orderBy('nombre')->get(),
        ]);
    }

    public function store(MaquinaRequest $request): RedirectResponse
    {
        $maquina = Maquina::create($request->validated());

        RegistroActividad::registrar("Registró la máquina \"{$maquina->nombre}\" ({$maquina->referencia})");

        return redirect()->route('maquinas.show', $maquina)->with('exito', 'Máquina registrada. Ahora completa su hoja de vida.');
    }

    public function show(Maquina $maquina): View
    {
        $maquina->load(['proveedor', 'hojaVida']);

        return view('maquinas.show', [
            'maquina' => $maquina,
            'mantenimientos' => $maquina->mantenimientos()->latest('fecha')->latest('id_mantenimiento')->get(),
        ]);
    }

    public function edit(Maquina $maquina): View
    {
        return view('maquinas.form', [
            'maquina' => $maquina,
            'proveedores' => Proveedor::orderBy('nombre')->get(),
        ]);
    }

    public function update(MaquinaRequest $request, Maquina $maquina): RedirectResponse
    {
        $maquina->update($request->validated());

        RegistroActividad::registrar("Editó la máquina \"{$maquina->nombre}\"");

        return redirect()->route('maquinas.show', $maquina)->with('exito', 'Máquina actualizada.');
    }

    public function destroy(Maquina $maquina): RedirectResponse
    {
        $maquina->delete();

        RegistroActividad::registrar("Eliminó la máquina \"{$maquina->nombre}\"");

        return redirect()->route('maquinas.index')->with('exito', 'Máquina eliminada.');
    }
}
