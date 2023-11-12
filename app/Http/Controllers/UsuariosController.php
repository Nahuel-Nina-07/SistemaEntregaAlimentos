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
}
