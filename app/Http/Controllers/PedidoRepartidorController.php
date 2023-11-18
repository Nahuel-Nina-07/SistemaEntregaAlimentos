<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\AsignacionPedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PedidoRepartidorController extends Controller
{
    public function mostrarMapa()
    {
        $repartidor = Auth::user();

        // Obtener los pedidos pendientes y los aceptados por el repartidor actual
        $pedidos = Pedido::where(function ($query) use ($repartidor) {
            // Pedidos pendientes o aceptados por el repartidor actual
            $query->whereIn('estado', ['pendiente', 'aceptado'])
                ->orWhere('repartidor_id_aceptado', $repartidor->id);
        })->get();

        return view('repartidor', compact('pedidos'));
    }

    public function pedidosPendientes()
    {
        $repartidor = Auth::user();

        // Obtener el pedido aceptado por el repartidor actual
        $pedidoAceptado = Pedido::where('repartidor_id_aceptado', $repartidor->id)
            ->where('estado', 'aceptado')
            ->first();

        // Obtener los pedidos pendientes (no aceptados por el repartidor actual)
        $pedidosPendientes = Pedido::whereNotExists(function ($query) use ($repartidor) {
            $query->select(DB::raw(1))
                ->from('asignacion_pedidos')
                ->whereColumn('asignacion_pedidos.pedido_id', 'pedidos.id')
                ->where('asignacion_pedidos.repartidor_id', '!=', $repartidor->id)
                ->where('asignacion_pedidos.estado_asignacion', 'en camino');
        })
            ->whereIn('estado', ['pendiente', 'aceptado'])
            ->get();

        // Si hay un pedido aceptado, lo agregamos a la colección
        if ($pedidoAceptado) {
            $pedidos = collect([$pedidoAceptado]);
        } else {
            $pedidos = $pedidosPendientes;
        }

        return response()->json(['pedidos' => $pedidos]);
    }

    public function aceptarPedido(Request $request, $pedidoId)
    {
        // Obtener el repartidor autenticado
        $repartidor = Auth::user();

    // Verificar si el pedido ya ha sido aceptado
    $pedido = Pedido::find($pedidoId);
    if ($pedido->estado === 'aceptado') {
        return response()->json(['message' => 'Este pedido ya ha sido aceptado.']);
    }

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
        $pedido->repartidor_id_aceptado = $repartidor->id;
        $pedido->save();

        // Crear un nuevo registro en la tabla AsignacionPedido
        $asignacion = new AsignacionPedido();
        $asignacion->pedido_id = $pedidoId;
        $asignacion->repartidor_id = $repartidor->id;
        $asignacion->estado_asignacion = 'en camino';
        $asignacion->save();

        // Obtener solo los pedidos pendientes y el pedido aceptado por el repartidor actual
        $pedidos = Pedido::where(function ($query) use ($repartidor) {
            // Pedidos pendientes o aceptados por el repartidor actual
            $query->whereIn('estado', ['pendiente', 'aceptado'])
                ->orWhere('repartidor_id_aceptado', $repartidor->id);
        })->get();

        // Retornar la respuesta JSON
        return response()->json(['message' => 'Pedido aceptado', 'pedidos' => $pedidos]);
    }

    public function cancelarPedido(Request $request, $pedidoId)
    {
        // Cambiar el estado del pedido a "pendiente"
        $pedido = Pedido::find($pedidoId);
        $pedido->estado = 'pendiente';

        // Restablecer el repartidor_id_aceptado a null
        $pedido->repartidor_id_aceptado = null;

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
