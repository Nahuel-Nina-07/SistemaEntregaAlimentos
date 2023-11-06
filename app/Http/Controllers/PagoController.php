<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallePedido;
use App\Models\Pedido;


class PagoController extends Controller
{
    public function mostrarPago()
    {
        // Obtén el usuario actual (puedes personalizar esta lógica según tu autenticación)
        $user = auth()->user();

        // Obtén el pedido en proceso del usuario actual
        $pedido = Pedido::where('usuario_id', $user->id)->where('estado', 'en proceso')->first();

        if (!$pedido) {
            // Si no hay un pedido en proceso, redirige de nuevo a la página de carrito 
            return redirect()->back();
        }

        // Obtén los detalles del carrito
        $detalles = DetallePedido::where('pedido_id', $pedido->id)->get();


        // Calcula el total
        $total = 0;
        foreach ($detalles as $detalle) {
            $total += $detalle->precio_unitario;
        }

        // Calcula el descuento exacto del 3% si el total es mayor o igual a 1,500.00
        $descuento = 0;
        if ($total >= 1500.00) {
            $descuento = 0.03 * $total;
        }

        // Resta el descuento al total
        $total -= $descuento;

        return view('Pago.pago', compact('detalles', 'total', 'descuento'));
    }

}