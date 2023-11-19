<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleRepartidor;

class RepartidoresController extends Controller
{
    public function mostrarRepartidores()
    {
        // Obtener la información completa de los repartidores, incluyendo la tabla users
        $repartidores = DetalleRepartidor::with('user')->get();

        // Pasar los datos a la vista
        return view('repartidores.mapa', compact('repartidores'));
    }
}
