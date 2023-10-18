<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrarRestaurante;

class AdminSolicitudRestauranteController extends Controller
{
    public function index($estado = 'todos')
    {
        if ($estado === 'todos') {
            $solicitudes = RegistrarRestaurante::select('id', 'LogoImg', 'NombreNegocio')->get();
        } else {
            $estadoSolicitud = 0; // Por defecto, pendientes
            if ($estado === 'aceptados') {
                $estadoSolicitud = 1;
            } elseif ($estado === 'rechazados') {
                $estadoSolicitud = 2;
            }

            $solicitudes = RegistrarRestaurante::select('id', 'LogoImg', 'NombreNegocio')
                ->where('estadoSolicitud', $estadoSolicitud)
                ->get();
        }

        $aceptados = RegistrarRestaurante::where('estadoSolicitud', 1)->get();
        $pendientes = RegistrarRestaurante::where('estadoSolicitud', 0)->get();
        $rechazados = RegistrarRestaurante::where('estadoSolicitud', 2)->get();

        // Pasar los datos a la vista
        return view('solicitudes.indexRestaurantes', compact('solicitudes', 'aceptados', 'pendientes', 'rechazados'));
    }
}
