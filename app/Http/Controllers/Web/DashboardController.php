<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AlertaInventario;
use App\Models\Mantenimiento;
use App\Models\Maquina;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $inicioMes = now()->startOfMonth();

        $datos = [
            'totalProductos' => Producto::count(),
            'totalStockBajo' => Producto::stockBajo()->count(),
            'alertasSinLeer' => AlertaInventario::noLeidas()->count(),
            'totalMaquinas' => Maquina::count(),
            'mantenimientosMes' => Mantenimiento::where('fecha', '>=', $inicioMes)->count(),
            'productosStockBajo' => Producto::stockBajo()->orderBy('cantidad')->limit(6)->get(),
            'ultimosMantenimientos' => Mantenimiento::with('maquina')->latest('fecha')->latest('id_mantenimiento')->limit(5)->get(),
            'ultimosMovimientos' => MovimientoInventario::with('producto')->latest('id_movimiento')->limit(6)->get(),
            'ventasMes' => null,
            'gananciaMes' => null,
        ];

        if ($request->user()->esAdministrador()) {
            $datos['ventasMes'] = (float) Venta::where('fecha', '>=', $inicioMes)->sum('total_venta');
            $datos['gananciaMes'] = (float) Venta::where('fecha', '>=', $inicioMes)->sum('ganancia_total');
        }

        return view('dashboard', $datos);
    }
}
