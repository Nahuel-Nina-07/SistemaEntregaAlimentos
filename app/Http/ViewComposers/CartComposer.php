<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;


class CartComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $pedido = Pedido::where('usuario_id', $user->id)->where('estado', 'en proceso')->first();
        $detalles = [];

        if ($pedido) {
            $detalles = DetallePedido::where('pedido_id', $pedido->id)->with('producto')->get();
        }

        $view->with('detalles', $detalles);
    }
}
