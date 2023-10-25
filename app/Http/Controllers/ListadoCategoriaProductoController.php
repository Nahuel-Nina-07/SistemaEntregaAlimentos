<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ListadoCategoriaProductoController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProducto::all(); // Obtén todas las categorías de restaurantes

        $listado = Producto::all();
        return view('Listado.categoriaProducto', ['categorias' => $categorias , 'listado' => $listado]);
    }

    public function productoCategoria($categoria_id)
    {
        $productos = Producto::where('categoria_id', $categoria_id)->get();

        return view('Listado.productos', compact('productos'));
    }
}
