<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        return redirect()->route('usuarios.index');
    }
}
