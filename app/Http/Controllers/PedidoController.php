<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;
class PedidoController extends Controller
{
    public function agregarProducto(Producto $producto)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            // Lógica para agregar el producto al pedido (por ejemplo, usando Eloquent)

            // Esto es un ejemplo, deberás ajustarlo a tu modelo de datos.
            $pedido = Pedido::create([
                'usuario_id' => $usuario->id,
                'fecha_hora_pedido' => now(),
                'total' => $producto->precio,
                'direccionEntrega' => 1,
            ]);

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id,
                'cantidad' => 1, // Puedes ajustar la cantidad según tus necesidades.
                'precio_unitario' => $producto->precio,
            ]);

            return redirect()->back()->with('success', 'Producto agregado al pedido.');
        } else {
            return redirect()->route('login'); // Redirige al inicio de sesión si el usuario no está autenticado.
        }
    }
}
