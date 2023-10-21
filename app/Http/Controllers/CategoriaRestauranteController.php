<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaRestaurante;
use Illuminate\Support\Facades\Storage;


class CategoriaRestauranteController extends Controller
{
    public function index()
    {
        $categorias = CategoriaRestaurante::all();
        return view('CategoriaRestaurante.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required',
        ]);

        $imagePath = $request->file('imagen')->store('public/images'); // Almacena la imagen en la carpeta 'public/images'
        $url = Storage::url($imagePath);

        CategoriaRestaurante::create([
            'nombre' => $request->input('nombre'),
            'imagen' => $url,
        ]);

        return redirect()->route('categoriasRestaurantes.index');
    }

    public function update(Request $request, CategoriaRestaurante $categoria)
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

        return redirect()->route('categoriasRestaurantes.index');
    }
    public function destroy(CategoriaRestaurante $categoria)
    {
        $categoria->delete();

        return redirect()->route('categoriasRestaurantes.index');
    }
}
