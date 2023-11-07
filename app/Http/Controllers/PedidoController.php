<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;


class PedidoController extends Controller
{
    public function agregarAlPedido(Producto $producto)
    {
        // Obtén el usuario actual (puedes personalizar esta lógica según tu autenticación)
        $user = auth()->user();

        // Verifica si el usuario ya tiene un pedido en estado "en proceso"
        $pedido = Pedido::where('usuario_id', $user->id)->where('estado', 'en proceso')->first();

        // Si el usuario no tiene un pedido "en proceso", crea uno nuevo
        if (!$pedido) {
            $pedido = new Pedido();
            $pedido->usuario_id = $user->id;
            $pedido->estado = 'en proceso';
            $pedido->fecha_hora_pedido = now();
            $pedido->direccionEntrega = 0;
            $pedido->save();
        }

        // Verifica si el producto ya está en el carrito
        $detallePedido = DetallePedido::where('pedido_id', $pedido->id)->where('producto_id', $producto->id)->first();

        if ($detallePedido) {
            // El producto ya está en el carrito, actualiza la cantidad
            $detallePedido->cantidad += 1;
            $detallePedido->save();

            // Resta 1 al stock del producto
            $producto->stock -= 1;
            $producto->save();
        } else {
            // El producto no está en el carrito, crea un nuevo detallePedido
            $detallePedido = new DetallePedido();
            $detallePedido->pedido_id = $pedido->id;
            $detallePedido->producto_id = $producto->id;
            $detallePedido->cantidad += 1;
            $detallePedido->precio_unitario = $producto->precio;
            $detallePedido->save();

            // Resta 1 al stock del producto
            $producto->stock -= 1;
            $producto->save();
        }

        session()->flash('alert', ['type' => 'success', 'message' => 'El producto se ha agregado al carrito con éxito.']);

        return redirect()->back();
    }

    public function detalles()
    {
        // Obtén el usuario actual
        $user = Auth::user();

        // Obtén el pedido en proceso del usuario
        $pedido = Pedido::where('usuario_id', $user->id)->where('estado', 'en proceso')->first();

        if (!$pedido) {
            return view('detalles', ['detalles' => []]);
        }

        // Obtén los detalles del pedido
        $detalles = DetallePedido::where('pedido_id', $pedido->id)->with('producto')->get();

        return view('detalles', ['detalles' => $detalles]);
    }

    public function eliminarProducto(DetallePedido $detallePedido)
    {
        // Obtén la cantidad eliminada del detalle del pedido
        $cantidadEliminada = $detallePedido->cantidad;

        $detallePedido->delete();

        // Restaura la cantidad eliminada al stock del producto
        $producto = $detallePedido->producto;
        $producto->stock += $cantidadEliminada;
        $producto->save();

        // Verifica si el pedido no tiene más detalles
        $pedido = Pedido::find($detallePedido->pedido_id);
        $detalles = DetallePedido::where('pedido_id', $pedido->id)->count();

        if ($detalles == 0) {
            $pedido->delete();
        }

        return redirect()->back();
    }

    public function actualizarCantidad($id, Request $request)
    {
        $detalle = DetallePedido::findOrFail($id);
        $nuevaCantidad = $request->input('nueva_cantidad');

        // Calcular la diferencia entre la nueva cantidad y la cantidad anterior
        $diferencia = $nuevaCantidad - $detalle->cantidad;

        // Actualizar la cantidad en el detalle del pedido
        $detalle->cantidad = $nuevaCantidad;
        $detalle->save();

        // Obtener el producto asociado al detalle del pedido
        $producto = $detalle->producto;

        // Actualizar el stock del producto teniendo en cuenta la diferencia
        $producto->stock -= $diferencia;
        $producto->save();

        // Calcular el nuevo precio unitario
        $detalle->precio_unitario = number_format($producto->precio * $nuevaCantidad, 2, '.', '');
        $detalle->save();

        return response()->json(['precio_unitario' => $detalle->precio_unitario]);
    }
}
