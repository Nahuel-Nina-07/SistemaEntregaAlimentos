<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetalleRepartidor;

class PerfilRepartidoresController extends Controller
{
    // RepartidoresDetalleController.php

    public function detalle($id)
    {
        $usuario = User::with('detalleRepartidor')->findOrFail($id);

        return view('detalles.usuario', compact('usuario'));
    }

    public function toggleStatus($id)
    {
        $usuario = User::find($id);

        if ($usuario) {
            $usuario->status = ($usuario->status == 1) ? 0 : 1; // Cambiar el estado a 0 o 1
            $usuario->save();
        }

        return redirect()->route('user.details',['id' => $id]);
    }

}
