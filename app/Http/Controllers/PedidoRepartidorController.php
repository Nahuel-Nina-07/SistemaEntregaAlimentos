<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\RepartidoresPedidos;
use Illuminate\Support\Facades\Auth;


class PedidoRepartidorController extends Controller
{
    public function mostrarMapa()
    {
        $pedidos = Pedido::all();
        return view('repartidor', compact('pedidos'));
    }
    public function aceptarPedido(Request $request, $pedidoId)
    {
        // Obtén el ID del repartidor autenticado
        $repartidorId = Auth::id();

        // Cambiar el estado del pedido a "aceptado"
        $pedido = Pedido::find($pedidoId);
        $pedido->estado = 'aceptado';
        $pedido->save();

        // Guardar la relación entre el repartidor y el pedido en la tabla intermedia
        RepartidoresPedidos::create([
            'pedido_id' => $pedidoId,
            'repartidor_id' => $repartidorId,
            'estado' => 'en_camino',
        ]);

        // Retornar la información del pedido (puedes personalizarlo según tus necesidades)
        return response()->json(['message' => 'Pedido aceptado', 'pedido' => $pedido]);
    }
}
