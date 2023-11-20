<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;

class UsuariosController extends Controller
{
    public function index()
    {
        // Obtén todos los usuarios
        $usuarios = User::with('roles')->get();

        return view('usuarios.index', compact('usuarios'));
    }
    public function toggleStatus($id)
    {
        $usuario = User::find($id);

        if ($usuario) {
            $usuario->status = ($usuario->status == 1) ? 0 : 1; // Cambiar el estado a 0 o 1
            $usuario->save();
        }

        return back();
    }

    public function detalles($id)
    {
        // Obtén el usuario por ID
        $usuario = User::findOrFail($id);

        // Verifica si el usuario es un repartidor o no (puedes ajustar esto según tus necesidades)
        $esRepartidor = $usuario->hasRole('repartidor');

        // Retornar la vista adecuada según el rol del usuario
        return view($esRepartidor ? 'usuarios.detalles_repartidor' : 'usuarios.detalles_usuario', compact('usuario'));
    }

    public function historialPedidos($usuarioId)
{
    // Obtén todos los pedidos hechos por el usuario específico
    $pendientes = Pedido::where('usuario_id', $usuarioId)
        ->where('estado', 'pendiente')
        ->get();

    $enCamino = Pedido::where('usuario_id', $usuarioId)
        ->where('estado', 'en camino') // Cambiado de 'aceptado' a 'en_camino'
        ->get();

    $completados = Pedido::where('usuario_id', $usuarioId)
        ->where('estado', 'completado') // Cambiado de 'aceptado' a 'completado'
        ->get();

    $cancelados = Pedido::where('usuario_id', $usuarioId)
        ->where('estado', 'cancelado') // Cambiado de 'rechazado' a 'cancelado'
        ->get();

    return view('PedidosHechos.pedidosHechos', compact('pendientes', 'enCamino', 'completados', 'cancelados'));
}

}
