<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AlertaInventario;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AlertaController extends Controller
{
    public function index(): View
    {
        return view('alertas.index', [
            'alertas' => AlertaInventario::with('producto')
                ->orderBy('leido')
                ->latest('id_alerta')
                ->paginate(20),
        ]);
    }

    public function marcarLeida(AlertaInventario $alerta): RedirectResponse
    {
        $alerta->update(['leido' => true]);

        return back()->with('exito', 'Alerta marcada como leída.');
    }

    public function marcarTodas(): RedirectResponse
    {
        AlertaInventario::noLeidas()->update(['leido' => true]);

        return back()->with('exito', 'Todas las alertas fueron marcadas como leídas.');
    }
}
