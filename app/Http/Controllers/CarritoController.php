<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Alimento;
use App\Models\Carrito;
use App\Models\Factura;
use App\Models\User;
use App\Models\DetalleFactura;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index(Request $request)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al carrito.');
        }

        // Obtener todos los alimentos en el carrito del usuario actual
        $user = Auth::user(); // Obtén el usuario autenticado
        $alimentosEnCarrito = $user->carrito;

        // Calcular el precio total
        $precioTotal = 0;
        foreach ($alimentosEnCarrito as $carritoItem) {
            $precioTotal += $carritoItem->alimento->costo * $carritoItem->cantidad;
        }

        return view('carrito.index', [
            'alimentosEnCarrito' => $alimentosEnCarrito,
            'precioTotal' => $precioTotal,
        ]);
    }

    public function agregar(Request $request, $alimentoId)
    {
        // Obtener el alimento a agregar al carrito
        $alimento = Alimento::find($alimentoId);

        if (!$alimento) {
            // Manejar el caso en que el alimento no existe
            return redirect()->back()->with('error', 'El alimento no existe.');
        }

        // Obtener el usuario actual
        $user = $request->user();

        // Verificar si el alimento ya está en el carrito
        $carritoExistente = Carrito::where('user_id', $user->id)
            ->where('alimento_id', $alimento->id)
            ->first();

        if ($carritoExistente) {
            // Si el alimento ya está en el carrito, aumentar la cantidad
            $carritoExistente->cantidad += 1;
            $carritoExistente->save();
        } else {
            // Si el alimento no está en el carrito, crear un nuevo registro
            $carritoNuevo = new Carrito();
            $carritoNuevo->user_id = $user->id;
            $carritoNuevo->alimento_id = $alimento->id;
            $carritoNuevo->cantidad = 1;
            $carritoNuevo->save();
        }

        return redirect()->route('carrito.index')->with('success', 'El alimento se ha agregado al carrito.');
    }

    public function eliminar(Request $request, $carritoId)
    {
        // Obtener el registro del carrito que se desea eliminar
        $carritoItem = Carrito::find($carritoId);

        if (!$carritoItem) {
            // Manejar el caso en que el registro del carrito no existe
            return redirect()->back()->with('error', 'El elemento del carrito no existe.');
        }

        // Verificar si el usuario actual es dueño del elemento del carrito
        if ($carritoItem->user_id === $request->user()->id) {
            // Eliminar el elemento del carrito
            $carritoItem->delete();
            return redirect()->route('carrito.index')->with('success', 'El alimento se ha eliminado del carrito.');
        }

        // Manejar el caso en que el usuario no tenga permisos para eliminar el elemento del carrito
        return redirect()->back()->with('error', 'No tienes permisos para eliminar este elemento del carrito.');
    }

//     public function checkout(Request $request)
// {
//     // Verifica si el usuario está autenticado
//     if (!Auth::check()) {
//         return redirect()->route('login')->with('error', 'Debes iniciar sesión para completar la compra.');
//     }

//     // Obtén el usuario autenticado
//     $user = Auth::user();

//     // Obtén todos los alimentos en el carrito del usuario
//     $carritoItems = $user->carrito;

//     if ($carritoItems->isEmpty()) {
//         return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
//     }

//     // Calcular el precio total
//     $total = 0;
//     foreach ($carritoItems as $carritoItem) {
//         $total += $carritoItem->alimento->costo * $carritoItem->cantidad;
//     }

//     // Crear la factura
//     $factura = Factura::create([
//         'user_id' => $user->id,
//         'fecha' => now(),
//         'total' => $total,
//     ]);

//     // Guardar los detalles de la factura (elementos del carrito)
//     foreach ($carritoItems as $carritoItem) {
//         DetalleFactura::create([
//             'factura_id' => $factura->id,
//             'alimento_id' => $carritoItem->alimento->id,
//             'cantidad' => $carritoItem->cantidad,
//             'subtotal' => $carritoItem->alimento->costo * $carritoItem->cantidad,
//         ]);
//     }

//     // Limpiar el carrito del usuario
//     $user->carrito()->delete();

//     return redirect()->route('facturas.show', $factura->id)->with('success', 'Compra realizada con éxito.');
// }
}
