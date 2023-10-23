<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaRestaurante;
use App\Models\Restaurante;

class ListadoCategoriaRestauranteControoller extends Controller
{
    public function index()
    {
        $categorias = CategoriaRestaurante::all(); // Obtén todas las categorías de restaurantes

        return view('Listado.categoriaRestaurante', ['categorias' => $categorias]);
    }
}
