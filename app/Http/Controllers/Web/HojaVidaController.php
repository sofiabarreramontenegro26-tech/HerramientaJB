<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\HojaVidaRequest;
use App\Models\HojaVida;
use App\Models\Maquina;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HojaVidaController extends Controller
{
    public function edit(Maquina $maquina): View
    {
        return view('hojas-vida.form', [
            'maquina' => $maquina,
            'hojaVida' => $maquina->hojaVida ?? new HojaVida(['fecha_ingreso' => now()]),
        ]);
    }

    public function update(HojaVidaRequest $request, Maquina $maquina): RedirectResponse
    {
        $maquina->hojaVida()->updateOrCreate(
            ['id_maquina' => $maquina->id_maquina],
            $request->validated()
        );

        RegistroActividad::registrar("Actualizó la hoja de vida de \"{$maquina->nombre}\"");

        return redirect()->route('maquinas.show', $maquina)->with('exito', 'Hoja de vida guardada.');
    }
}
