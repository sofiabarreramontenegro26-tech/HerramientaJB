<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\MantenimientoRequest;
use App\Models\Mantenimiento;
use App\Models\Maquina;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MantenimientoController extends Controller
{
    public function index(Request $request): View
    {
        $tipo = $request->query('tipo');

        $mantenimientos = Mantenimiento::with('maquina')
            ->when(in_array($tipo, Mantenimiento::TIPOS, true), fn ($q) => $q->where('tipo_mantenimiento', $tipo))
            ->latest('fecha')
            ->latest('id_mantenimiento')
            ->paginate(15)
            ->withQueryString();

        return view('mantenimientos.index', ['mantenimientos' => $mantenimientos]);
    }

    public function create(Request $request): View
    {
        return view('mantenimientos.form', [
            'mantenimiento' => new Mantenimiento([
                'id_maquina' => $request->integer('maquina') ?: null,
                'fecha' => now(),
                'tecnico_responsable' => $request->user()->nombre_completo,
                'tipo_mantenimiento' => Mantenimiento::PREVENTIVO,
            ]),
            'maquinas' => Maquina::orderBy('nombre')->get(),
        ]);
    }

    public function store(MantenimientoRequest $request): RedirectResponse
    {
        $mantenimiento = Mantenimiento::create($request->validated());

        RegistroActividad::registrar("Registró mantenimiento {$mantenimiento->tipo_mantenimiento} en \"{$mantenimiento->maquina->nombre}\"");

        return redirect()->route('maquinas.show', $mantenimiento->id_maquina)->with('exito', 'Mantenimiento registrado.');
    }

    public function edit(Mantenimiento $mantenimiento): View
    {
        return view('mantenimientos.form', [
            'mantenimiento' => $mantenimiento,
            'maquinas' => Maquina::orderBy('nombre')->get(),
        ]);
    }

    public function update(MantenimientoRequest $request, Mantenimiento $mantenimiento): RedirectResponse
    {
        $mantenimiento->update($request->validated());

        RegistroActividad::registrar("Editó el mantenimiento #{$mantenimiento->id_mantenimiento}");

        return redirect()->route('maquinas.show', $mantenimiento->id_maquina)->with('exito', 'Mantenimiento actualizado.');
    }

    public function destroy(Mantenimiento $mantenimiento): RedirectResponse
    {
        $idMaquina = $mantenimiento->id_maquina;
        $mantenimiento->delete();

        RegistroActividad::registrar("Eliminó el mantenimiento #{$mantenimiento->id_mantenimiento}");

        return redirect()->route('maquinas.show', $idMaquina)->with('exito', 'Mantenimiento eliminado.');
    }
}
