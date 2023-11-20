<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\AsignacionPedido;
use App\Models\User;
use App\Models\Reporte;
use Carbon\Carbon;
use App\Models\Producto;

class PedidosHechosController extends Controller
{
    public function index()
    {
        // Obtén todos los pedidos hechos por el usuario actual
        $pendientes = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'pendiente')
            ->get();

        $enCamino = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'en camino')
            ->get();

        $completados = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'completado')
            ->get();

        $cancelados = Pedido::where('usuario_id', auth()->user()->id)
            ->where('estado', 'cancelado')
            ->get();

        foreach ($pendientes as $pedido) {
            $pedido->totalPedido = $pedido->detalles->sum(function ($detalle) {
                return $detalle->cantidad * $detalle->precio_unitario;
            });
        }

        foreach ($enCamino as $pedido) {
            $pedido->totalPedido = $pedido->detalles->sum(function ($detalle) {
                return $detalle->cantidad * $detalle->precio_unitario;
            });
        }
    
        foreach ($completados as $pedido) {
            $pedido->totalPedido = $pedido->detalles->sum(function ($detalle) {
                return $detalle->cantidad * $detalle->precio_unitario;
            });
        }
    
        foreach ($cancelados as $pedido) {
            $pedido->totalPedido = $pedido->detalles->sum(function ($detalle) {
                return $detalle->cantidad * $detalle->precio_unitario;
            });
        }

        return view('PedidosHechos.pedidosHechos', compact('pendientes', 'enCamino', 'completados', 'cancelados'));
    }

    public function detalles($pedidoId)
    {
        // Obtener el pedido y la asignación correspondiente
        $pedido = Pedido::findOrFail($pedidoId);
        $asignacion = AsignacionPedido::with('repartidor')->where('pedido_id', $pedidoId)->first();

        // Obtener los detalles del repartidor y los productos del pedido
        $repartidor = $asignacion ? $asignacion->repartidor->load('detalleRepartidor') : null;
        $detallesProductos = $pedido->detalles;

        // Calcular el total considerando los subtotales de los productos
        $totalPedido = $detallesProductos->sum(function ($detalle) {
            return $detalle->cantidad * $detalle->precio_unitario;
        });

        return view('PedidosHechos.detalles', compact('pedido', 'repartidor', 'detallesProductos', 'totalPedido'));
    }

    public function reportarRepartidor(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'repartidor_id' => 'required|exists:users,id',
            'motivo' => 'required',
        ]);

        // Verificar si ya existe un reporte para este repartidor y usuario
        $existeReporte = Reporte::where('user_id', auth()->user()->id)
            ->where('repartidor_id', $request->repartidor_id)
            ->exists();

        // Si ya existe un reporte, redirigir con un mensaje de error.
        if ($existeReporte) {
            return redirect()->back()->with('error', 'Ya has reportado a este repartidor anteriormente.');
        }

        // Crear el reporte
        Reporte::create([
            'user_id' => auth()->user()->id,
            'repartidor_id' => $request->repartidor_id,
            'motivo' => $request->motivo,
            'fecha_reporte' => Carbon::now(),
        ]);
        User::find($request->repartidor_id)->increment('reportes_count');

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Reporte enviado correctamente');
    }

    public function cancelarPedido($pedidoId)
    {
        // Obtener el pedido
        $pedido = Pedido::findOrFail($pedidoId);

        // Verificar si el pedido está en estado 'pendiente'
        if ($pedido->estado === 'pendiente') {
            // Revertir la cantidad de productos al stock
            foreach ($pedido->detalles as $detalle) {
                $producto = $detalle->producto;
                $producto->stock += $detalle->cantidad; // Ajustar el stock sumando la cantidad cancelada
                $producto->save();
            }

            // Cambiar el estado del pedido a 'cancelado'
            $pedido->estado = 'cancelado';
            $pedido->save();

            return redirect()->back()->with('success', 'Pedido cancelado correctamente.');
        }

        return redirect()->back()->with('error', 'No se puede cancelar un pedido que no está en estado pendiente.');
    }

    public function cancelarPedidoPendiente($pedidoId)
    {
        // Obtener el pedido
        $pedido = Pedido::findOrFail($pedidoId);

        // Verificar si han pasado más de 7 minutos
        $fechaHoraPedido = Carbon::parse($pedido->fecha_hora_pedido);
        $diferenciaMinutos = Carbon::now()->diffInMinutes($fechaHoraPedido);

        if ($diferenciaMinutos > 7) {
            // No devolver productos al stock
        } else {
            // Devolver productos al stock
            foreach ($pedido->detalles as $detalle) {
                $producto = $detalle->producto;
                $producto->stock += $detalle->cantidad; // Ajustar el stock sumando la cantidad cancelada
                $producto->save();
            }
        }

        // Cambiar el estado del pedido a "cancelado"
        $pedido->update(['estado' => 'cancelado']);

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Pedido cancelado correctamente');
    }

    public function detallesProductos($pedidoId)
    {
        // Obtener el pedido
        $pedido = Pedido::findOrFail($pedidoId);

        // Obtener los detalles de los productos del pedido
        $detallesProductos = $pedido->detalles;

        $totalPedido = $detallesProductos->sum(function ($detalle) {
            return $detalle->cantidad * $detalle->precio_unitario;
        });

        return view('PedidosHechos.detallesProductos', compact('pedido', 'detallesProductos', 'totalPedido'));
    }
}
