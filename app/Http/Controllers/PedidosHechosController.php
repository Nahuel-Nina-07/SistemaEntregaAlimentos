<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\AsignacionPedido;
use App\Models\User;
use App\Models\Reporte;
use Carbon\Carbon;

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

    public function detalles($pedidoId)
{
    // Obtener el pedido y la asignación correspondiente
    $pedido = Pedido::findOrFail($pedidoId);
    $asignacion = AsignacionPedido::with('repartidor')->where('pedido_id', $pedidoId)->first();

    // Obtener los detalles del repartidor y los productos del pedido
    $repartidor = $asignacion ? $asignacion->repartidor->load('detalleRepartidor') : null;
    $detallesProductos = $pedido->detalles;

    return view('PedidosHechos.detalles', compact('pedido', 'repartidor', 'detallesProductos'));
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
}
