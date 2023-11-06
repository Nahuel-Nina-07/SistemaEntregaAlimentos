<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaRestaurante;
use Illuminate\Support\Facades\Storage;


class CategoriaRestauranteController extends Controller
{
    public function index()
    {
        $categoriasRestaurantes = CategoriaRestaurante::all();
        return view('CategoriaRestaurante.index', compact('categoriasRestaurantes'));
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

    public function update(Request $request, CategoriaRestaurante $categoriasRestaurantes)
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

        $categoriasRestaurantes->update($data);

        return redirect()->route('categoriasRestaurantes.index');
    }
    public function destroy(CategoriaRestaurante $categoriasRestaurantes)
    {
        $categoriasRestaurantes->delete();

        return redirect()->route('categoriasRestaurantes.index');
    }
}
