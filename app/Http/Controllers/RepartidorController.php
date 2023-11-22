<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\AsignacionPedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RepartidorController extends Controller
{
    public function pedidosPendientes()
    {
        // Obtener los pedidos pendientes
        $pedidosPendientes = Pedido::where('repartidor_id_aceptado', null)
            ->where('estado', 'pendiente')
            ->get();

        // Obtener el pedido aceptado si hay uno
        $pedidoAceptado = Pedido::where('repartidor_id_aceptado', auth()->user()->id)
            ->where('estado', 'en camino')
            ->first();

        // Verificar la distancia solo si hay un pedido aceptado
        $distanciaAlDestino = null;
        if ($pedidoAceptado) {
            $distanciaAlDestino = $this->calcularDistanciaEnMetros(
                auth()->user()->detalleRepartidor->ultima_latitud,
                auth()->user()->detalleRepartidor->ultima_longitud,
                $pedidoAceptado->latitud,
                $pedidoAceptado->longitud
            );
        }

        return view('repartidor.pendientes', compact('pedidosPendientes', 'pedidoAceptado', 'distanciaAlDestino'));
    }

    public function aceptarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);

        if ($pedido->estado === 'pendiente' && !$pedido->repartidor_id_aceptado) {
            // Verificar si el repartidor ya tiene un pedido en camino
            $repartidorEnCamino = Pedido::where('repartidor_id_aceptado', auth()->user()->id)
                ->where('estado', 'en camino')
                ->exists();

            if (!$repartidorEnCamino) {
                // Actualizar el estado del pedido a "En Camino" y asignar el repartidor
                $pedido->update(['estado' => 'en camino', 'repartidor_id_aceptado' => auth()->user()->id]);

                // Crear un registro en la tabla de asignación de pedidos
                AsignacionPedido::create([
                    'pedido_id' => $pedido->id,
                    'repartidor_id' => auth()->user()->id,
                    'estado_asignacion' => 'pendiente',
                ]);

                // Puedes agregar aquí lógica adicional según tus necesidades

                return redirect()->route('pedidos.pendientes');
            } else {
                // Si el repartidor ya tiene un pedido en camino, mostrar alerta
                return redirect()->route('pedidos.pendientes');
            }
        } else {
            return redirect()->route('pedidos.pendientes');
        }
    }

    private function calcularDistanciaEnMetros($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radio de la Tierra en kilómetros

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distanciaEnKilometros = $earthRadius * $c;
        $distanciaEnMetros = $distanciaEnKilometros * 1000;

        return $distanciaEnMetros; // Distancia en metros
    }


    public function entregarPedido($id)
    {
        // Obtén el pedido
        $pedido = Pedido::findOrFail($id);

        // Verifica si el repartidor está a menos de 80 metros del destino
        $distanciaAlDestino = $this->calcularDistanciaEnMetros(
            $pedido->latitud,
            $pedido->longitud,
            $pedido->repartidor->ultima_latitud,
            $pedido->repartidor->ultima_longitud
        );

        if ($pedido->estado === 'en camino' && $distanciaAlDestino < 80) {
            // Realiza las acciones necesarias para entregar el pedido
            // ...

            // Actualiza el estado del pedido a entregado
            $pedido->update(['estado' => 'entregado']);

            // Redirige o realiza otras acciones según tus necesidades
            return redirect()->route('pedidos.pendientes');
        } else {
            // Si el repartidor no está lo suficientemente cerca, muestra un mensaje o realiza otras acciones
            return redirect()->route('pedidos.pendientes')->with('error', 'No estás lo suficientemente cerca para entregar el pedido.');
        }
    }

    public function cancelarPedido(Request $request, $pedidoId)
    {
        try {
            // Cambiar el estado del pedido a "pendiente"
            $pedido = Pedido::find($pedidoId);
            $pedido->estado = 'pendiente';
            $pedido->repartidor_id_aceptado = null;
            $pedido->save();

            // Obtener y eliminar la asignación correspondiente de asignacion_pedidos
            $asignacion = AsignacionPedido::where('pedido_id', $pedidoId)->first();
            if ($asignacion) {
                $asignacion->delete();
            }

            // Retornar la respuesta JSON con un mensaje de éxito
            return response()->json(['success' => true, 'message' => 'Pedido cancelado con éxito']);
        } catch (\Exception $e) {
            // Si hay un error, retornar una respuesta JSON con un mensaje de error
            return response()->json(['success' => false, 'message' => 'Error al cancelar el pedido. Por favor, inténtalo de nuevo.']);
        }
    }

    public function detallesPedidoAceptado()
    {
        // Obtener el pedido aceptado con la información del usuario
        $pedidoAceptado = Pedido::where('repartidor_id_aceptado', Auth::user()->id)
            ->where('estado', 'en camino')
            ->with('usuario', 'productos')
            ->first();

        if (!$pedidoAceptado) {
            return redirect()->route('pedidos.pendientes')->with('error', 'No hay un pedido aceptado en este momento.');
        }

        return view('repartidor.detalles', compact('pedidoAceptado'));
    }
}
