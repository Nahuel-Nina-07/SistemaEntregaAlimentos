<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaRestaurante;
use App\Models\Restaurante;
use App\Models\CategoriaProducto;
use App\Models\Producto;

class ListadoCategoriaRestauranteController extends Controller
{
    public function index()
    {
        $categorias = CategoriaRestaurante::all(); // Obtén todas las categorías de restaurantes

        $listado = Restaurante::all();
        return view('Listado.categoriaRestaurante', ['categorias' => $categorias , 'listado' => $listado]);
    }

    public function restaurantesPorCategoria($categoria_id)
    {
        $restaurantes = Restaurante::where('categoria_id', $categoria_id)->get();

        return view('Listado.restaurantes', compact('restaurantes'));
    }

    public function verMenuRestaurante($restaurante_id)
    {
        $restaurante = Restaurante::findOrFail($restaurante_id);

        // Obtén las categorías asociadas a los productos de este restaurante
        $categorias = CategoriaProducto::whereHas('productos', function ($query) use ($restaurante_id) {
            $query->where('restaurante_id', $restaurante_id);
        })->get();

        // Obtén los productos ordenados por categoría
        $productosPorCategoria = [];
        foreach ($categorias as $categoria) {
            $productosPorCategoria[$categoria->nombre] = Producto::where('restaurante_id', $restaurante_id)
                ->where('categoria_id', $categoria->id)
                ->get();
        }

        return view('Listado.verMenu', compact('restaurante', 'productosPorCategoria'));
    }
}
