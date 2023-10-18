<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaProducto;
use Illuminate\Support\Facades\Storage;
class CategoriaProductoController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProducto::all();
        return view('CategoriaProducto.index', compact('categorias'));
    }

    public function create()
    {
        return view('CategoriaProducto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required',
        ]);

        $imagePath = $request->file('imagen')->store('public/images'); // Almacena la imagen en la carpeta 'public/images'
        $url = Storage::url($imagePath);

        CategoriaProducto::create([
            'nombre' => $request->input('nombre'),
            'imagen' => $url,
        ]);

        return redirect()->route('categorias.index');
    }

    public function edit(CategoriaProducto $categoria)
    {
        return view('CategoriaProducto.edit', compact('categoria'));
    }

    public function update(Request $request, CategoriaProducto $categoria)
    {
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'sometimes|image', // Cambiar a 'sometimes' para permitir la edición opcional de la imagen
        ]);

        $data = [
            'nombre' => $request->input('nombre'),
        ];

        if ($request->hasFile('imagen')) {
            // Si se proporciona una nueva imagen, mantén la misma ubicación de almacenamiento
            $imagePath = $request->file('imagen')->store('public/images');
            $data['imagen'] = Storage::url($imagePath);
        }

        $categoria->update($data);

        return redirect()->route('categorias.index');
    }
    public function destroy(CategoriaProducto $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}
