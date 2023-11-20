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

        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            // Obtener la última posición del repartidor desde la sesión
            $ultimaPosicion = session('ultima_posicion_repartidor');

            // Pasar la última posición a la vista
            return view('repartidores.mapa', compact('repartidores', 'ultimaPosicion'));
        }

        // Si el usuario no está autenticado, redirigirlo al login
        return redirect('login');
    }
}
