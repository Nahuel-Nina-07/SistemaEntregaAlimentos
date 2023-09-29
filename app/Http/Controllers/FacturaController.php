<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Factura;
use App\Models\DetalleFactura;

class FacturaController extends Controller
{
    public function checkout(Request $request)
{
    // Valida y guarda la factura en la base de datos
    $user = $request->user();
    $carritoItems = $user->carrito;

    if ($carritoItems->isEmpty()) {
        return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
    }

    // Calcular el total de la compra
    $total = 0;
    foreach ($carritoItems as $carritoItem) {
        $total += $carritoItem->alimento->costo * $carritoItem->cantidad;
    }

    // Crear la factura
    $factura = Factura::create([
        'user_id' => $user->id,
        'fecha' => now(), // Puedes usar Carbon para obtener la fecha actual
        'total' => $total,
    ]);

    // Guardar los detalles de la factura (elementos del carrito)
    foreach ($carritoItems as $carritoItem) {
        DetalleFactura::create([
            'factura_id' => $factura->id,
            'alimento_id' => $carritoItem->alimento->id,
            'cantidad' => $carritoItem->cantidad,
            'subtotal' => $carritoItem->alimento->costo * $carritoItem->cantidad,
        ]);
    }

    // Limpiar el carrito del usuario
    $user->carrito()->delete();

    return redirect()->route('facturas.show', $factura->id)->with('success', 'Compra realizada con éxito.');
}
}
