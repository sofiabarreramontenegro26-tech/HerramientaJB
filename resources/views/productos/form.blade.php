@extends('layouts.app')

@php $editando = $producto->exists; @endphp

@section('titulo', $editando ? 'Editar producto' : 'Nuevo producto')

@section('contenido')
    <x-encabezado :titulo="$editando ? 'Editar producto' : 'Nuevo producto'" :volver="route('productos.index')"
                  :subtitulo="$editando ? $producto->nombre : 'Registra un repuesto o pieza en el inventario.'" />

    <form method="POST" enctype="multipart/form-data"
          action="{{ $editando ? route('productos.update', $producto) : route('productos.store') }}"
          class="grid gap-6 lg:grid-cols-3">
        @csrf
        @if ($editando) @method('PUT') @endif

        <div class="panel space-y-5 p-6 lg:col-span-2">
            <h2 class="panel-titulo">Información general</h2>

            <div>
                <label for="nombre" class="etiqueta">Nombre *</label>
                <input id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" maxlength="100" required class="campo @error('nombre') campo-error @enderror">
                @error('nombre') <p class="texto-error">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="marca" class="etiqueta">Marca</label>
                    <input id="marca" name="marca" value="{{ old('marca', $producto->marca) }}" maxlength="100" class="campo @error('marca') campo-error @enderror">
                    @error('marca') <p class="texto-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="id_categoria" class="etiqueta">Categoría *</label>
                    <select id="id_categoria" name="id_categoria" required class="campo @error('id_categoria') campo-error @enderror">
                        <option value="">Selecciona…</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" @selected(old('id_categoria', $producto->id_categoria) == $categoria->id_categoria)>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_categoria') <p class="texto-error">{{ $message }}</p> @enderror
                    @if ($categorias->isEmpty())
                        <p class="ayuda">No hay categorías. <a href="{{ route('categorias.index') }}" class="text-industrial underline">Crea una primero</a>.</p>
                    @endif
                </div>
            </div>

            <div>
                <label for="id_proveedor" class="etiqueta">Proveedor</label>
                <select id="id_proveedor" name="id_proveedor" class="campo @error('id_proveedor') campo-error @enderror">
                    <option value="">Sin proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id_proveedor }}" @selected(old('id_proveedor', $producto->id_proveedor) == $proveedor->id_proveedor)>{{ $proveedor->nombre }}{{ $proveedor->empresa ? ' · ' . $proveedor->empresa : '' }}</option>
                    @endforeach
                </select>
                @error('id_proveedor') <p class="texto-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="descripcion" class="etiqueta">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="campo @error('descripcion') campo-error @enderror" placeholder="Medidas, voltaje, compatibilidad…">{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion') <p class="texto-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="imagen" class="etiqueta">Imagen</label>
                <div class="flex items-center gap-4">
                    <img id="vista-imagen" src="{{ $producto->imagen_url }}" alt="" class="{{ $producto->imagen_url ? '' : 'hidden' }} size-20 rounded-md border border-slate-700 object-cover">
                    <input id="imagen" name="imagen" type="file" accept="image/png,image/jpeg,image/webp" data-vista-previa="vista-imagen"
                           class="block w-full text-sm text-slate-400 file:mr-4 file:rounded-md file:border-0 file:bg-slate-800 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-200 hover:file:bg-slate-700">
                </div>
                <p class="ayuda">JPG, PNG o WEBP. Máximo 2 MB.</p>
                @error('imagen') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-6">
            <div class="panel space-y-5 p-6">
                <h2 class="panel-titulo">Stock</h2>

                @if ($editando)
                    <div>
                        <p class="etiqueta">Cantidad actual</p>
                        <p class="font-mono text-3xl font-semibold text-slate-50">{{ $producto->cantidad }}</p>
                        <p class="ayuda">El stock se cambia con entradas y salidas para que quede registro.</p>
                    </div>
                @else
                    <div>
                        <label for="cantidad" class="etiqueta">Cantidad inicial *</label>
                        <input id="cantidad" name="cantidad" type="number" min="0" value="{{ old('cantidad', $producto->cantidad) }}" required class="campo font-mono @error('cantidad') campo-error @enderror">
                        @error('cantidad') <p class="texto-error">{{ $message }}</p> @enderror
                    </div>
                @endif

                <div>
                    <label for="stock_minimo" class="etiqueta">Stock mínimo *</label>
                    <input id="stock_minimo" name="stock_minimo" type="number" min="0" value="{{ old('stock_minimo', $producto->stock_minimo) }}" required class="campo font-mono @error('stock_minimo') campo-error @enderror">
                    <p class="ayuda">Al llegar a este número se crea una alerta.</p>
                    @error('stock_minimo') <p class="texto-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="panel space-y-5 p-6">
                <h2 class="panel-titulo">Precios (COP)</h2>
                <div>
                    <label for="precio_compra" class="etiqueta">Precio de compra *</label>
                    <input id="precio_compra" name="precio_compra" type="number" min="0" step="0.01" value="{{ old('precio_compra', $producto->precio_compra) }}" required class="campo font-mono @error('precio_compra') campo-error @enderror">
                    @error('precio_compra') <p class="texto-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="precio_venta" class="etiqueta">Precio de venta *</label>
                    <input id="precio_venta" name="precio_venta" type="number" min="0" step="0.01" value="{{ old('precio_venta', $producto->precio_venta) }}" required class="campo font-mono @error('precio_venta') campo-error @enderror">
                    @error('precio_venta') <p class="texto-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-primario flex-1"><x-icono nombre="check" /> {{ $editando ? 'Guardar cambios' : 'Crear producto' }}</button>
                <a href="{{ route('productos.index') }}" class="btn btn-secundario">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
