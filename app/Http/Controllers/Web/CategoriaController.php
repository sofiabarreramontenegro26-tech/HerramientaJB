<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        return view('categorias.index', [
            'categorias' => Categoria::withCount('productos')->orderBy('nombre')->paginate(15),
        ]);
    }

    public function store(CategoriaRequest $request): RedirectResponse
    {
        $categoria = Categoria::create($request->validated());

        RegistroActividad::registrar("Creó la categoría \"{$categoria->nombre}\"");

        return redirect()->route('categorias.index')->with('exito', 'Categoría creada.');
    }

    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', ['categoria' => $categoria]);
    }

    public function update(CategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        RegistroActividad::registrar("Editó la categoría \"{$categoria->nombre}\"");

        return redirect()->route('categorias.index')->with('exito', 'Categoría actualizada.');
    }

    public function destroy(Categoria $categoria): RedirectResponse
    {
        if ($categoria->productos()->exists()) {
            return back()->with('error', 'No puedes eliminar una categoría que tiene productos.');
        }

        $categoria->delete();

        RegistroActividad::registrar("Eliminó la categoría \"{$categoria->nombre}\"");

        return redirect()->route('categorias.index')->with('exito', 'Categoría eliminada.');
    }
}
