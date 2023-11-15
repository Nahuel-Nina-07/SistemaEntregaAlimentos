<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\AsignacionPedido;
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
        // Obtener el repartidor autenticado
        $repartidor = Auth::user();

        // Verificar si el repartidor ya tiene un pedido aceptado
        $pedidoAsignado = AsignacionPedido::where('repartidor_id', $repartidor->id)
            ->where('estado_asignacion', 'en camino')
            ->first();

        if ($pedidoAsignado) {
            // Retornar una respuesta indicando que el repartidor ya tiene un pedido asignado
            return response()->json(['message' => 'Ya tienes un pedido asignado. No puedes aceptar otro.']);
        }

        // Cambiar el estado del pedido a "aceptado"
        $pedido = Pedido::find($pedidoId);
        $pedido->estado = 'aceptado';
        $pedido->save();

        // Crear un nuevo registro en la tabla AsignacionPedido
        $asignacion = new AsignacionPedido();
        $asignacion->pedido_id = $pedidoId;
        $asignacion->repartidor_id = $repartidor->id;
        $asignacion->estado_asignacion = 'en camino';
        $asignacion->save();

        // Retornar la respuesta JSON
        return response()->json(['message' => 'Pedido aceptado', 'pedido' => $pedido, 'asignacion' => $asignacion]);
    }


    public function cancelarPedido(Request $request, $pedidoId)
    {
        // Cambiar el estado del pedido a "pendiente"
        $pedido = Pedido::find($pedidoId);
        $pedido->estado = 'pendiente';
        $pedido->save();

        // Obtener y eliminar la asignación correspondiente de asignacion_pedidos
        $asignacion = AsignacionPedido::where('pedido_id', $pedidoId)->first();
        if ($asignacion) {
            $asignacion->delete();
        }

        // Retornar la respuesta JSON
        return response()->json(['message' => 'Pedido cancelado', 'pedido' => $pedido]);
    }
}
