<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function create()
    {
        $restaurantes = DB::table('restaurantes')->pluck('nombre', 'id');
        $productos = DB::table('categorias_productos')->pluck('nombre', 'id');
        return view('productos.index', compact('restaurantes', 'productos'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer',
            'restaurante_id' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
            'stock' => 'required|integer'
        ]);

        // Procesamiento de la imagen si se proporcionó
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('public/images');
            $url = Storage::url($imagePath);
        } else {
            return redirect()->back()->with('error', 'Debe cargar una imagen.'); // Si no se proporciona una imagen
        }

        // Creación del producto en la base de datos
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'restaurante_id' => $request->restaurante_id,
            'imagen' => $url,
            'stock' => $request->stock,
        ]);

        // Redirecciona a una página de éxito o a donde desees
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }
}
