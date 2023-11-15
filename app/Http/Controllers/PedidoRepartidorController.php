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

    public function pedidosPendientes()
    {
        $pedidosPendientes = Pedido::whereIn('estado', ['pendiente', 'aceptado'])->get();
        return response()->json(['pedidos' => $pedidosPendientes]);
    }

    public function aceptarPedido(Request $request, $pedidoId)
    {
        // Verificar que el usuario esté autenticado como repartidor
        $repartidorId = Auth::id();

        // Cambiar el estado del pedido a "aceptado"
        $pedido = Pedido::find($pedidoId);
        $pedido->estado = 'aceptado';
        $pedido->save();

        // Crear un nuevo registro en la tabla RepartidoresPedidos
        RepartidoresPedidos::create([
            'repartidor_id' => $repartidorId,
            'pedido_id' => $pedido->id,
            'estado' => 'en camino',  // Puedes ajustar el estado según tu lógica
        ]);

        return response()->json(['message' => 'Pedido aceptado', 'pedido' => $pedido]);
    }


    public function cancelarPedido(Request $request, $pedidoId)
    {
        $repartidorId = Auth::id();

        // Cambiar el estado del pedido a "pendiente"
        $pedido = Pedido::find($pedidoId);
        $pedido->estado = 'pendiente';
        $pedido->save();

        // Obtener la relación RepartidoresPedidos y eliminarla
        return response()->json(['message' => 'Pedido cancelado', 'pedido' => $pedido]);
    }
}
