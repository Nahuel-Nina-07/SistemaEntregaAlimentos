<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;

class PedidosHechosController extends Controller
{
    public function index()
    {
        // Obtén todos los pedidos hechos por el usuario actual
        $pendientes = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'pendiente')
            ->get();

        $aceptados = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'aceptado')
            ->get();

        $rechazados = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'rechazado')
            ->get();

        return view('PedidosHechos.pedidosHechos', compact('pendientes', 'aceptados', 'rechazados'));
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
