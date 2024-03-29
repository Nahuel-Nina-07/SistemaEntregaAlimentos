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
        $categorias = DB::table('categorias_productos')->pluck('nombre', 'id'); // Agrega esta línea
        $producto = Producto::with('categoria', 'restaurante')->get();
        return view('productos.list', compact('restaurantes', 'categorias', 'producto'));
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

    public function update(Request $request, Producto $producto)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer',
            'restaurante_id' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
            'stock' => 'required|integer'
        ]);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->restaurante_id = $request->restaurante_id;
        $producto->stock = $request->stock;

        if ($request->hasFile('imagen')) {
            // Procesar la nueva imagen si se proporciona
            $imagePath = $request->file('imagen')->store('public/images');
            $url = Storage::url($imagePath);
            $producto->imagen = $url;
        }
        // Guarda el producto actualizado en la base de datos
        $producto->save();
        // Redirecciona a una página de éxito o a donde desees
        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }


    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
