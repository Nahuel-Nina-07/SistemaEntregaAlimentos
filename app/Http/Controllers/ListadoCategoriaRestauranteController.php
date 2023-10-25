<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaRestaurante;
use App\Models\Restaurante;

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
}
