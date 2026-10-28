<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HistorialActividad;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistorialController extends Controller
{
    public function index(Request $request): View
    {
        $historial = HistorialActividad::with('usuario')
            ->when($request->filled('usuario'), fn ($q) => $q->where('id_usuario', $request->integer('usuario')))
            ->latest('id_historial')
            ->paginate(25)
            ->withQueryString();

        return view('historial.index', [
            'historial' => $historial,
            'usuarios' => Usuario::orderBy('nombre_completo')->get(),
        ]);
    }
}
