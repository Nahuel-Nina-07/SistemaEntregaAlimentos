<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;

class SolicitudTrabajoController extends Controller
{
    public function store(Request $request)
    {
        // Valida los datos de entrada
        $request->validate([
            'nombre_solicitante' => 'required|string',
            'correo_electronico_solicitante' => 'required|email',
            'telefono_solicitante' => 'required|string',
            'detalles_solicitud' => 'required|string',
            'edad' => 'nullable|integer',
            'tipo_vehiculo' => 'nullable|string',
            'imagen_propiedad_vehiculo' => 'nullable|string',
            'ci_numero' => 'nullable|integer',
            'numero_placa' => 'nullable|string',
        ]);

        // Obtén la fecha y hora actual del servidor
        $fechaSolicitud = now();

        // Crea una nueva instancia de SolicitudTrabajo con los datos del formulario
        $solicitud = new SolicitudTrabajo([
            'fecha_solicitud' => $fechaSolicitud,
            'nombre_solicitante' => $request->input('nombre_solicitante'),
            'correo_electronico_solicitante' => $request->input('correo_electronico_solicitante'),
            'telefono_solicitante' => $request->input('telefono_solicitante'),
            'detalles_solicitud' => $request->input('detalles_solicitud'),
            'edad' => $request->input('edad'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
            'imagen_propiedad_vehiculo' => $request->input('imagen_propiedad_vehiculo'),
            'ci_numero' => $request->input('ci_numero'),
            'numero_placa' => $request->input('numero_placa'),
        ]);

        $solicitud->save();

        if ($solicitud->wasRecentlyCreated) {
            return response()->json(['message' => 'Solicitud de trabajo creada con éxito', 'solicitud' => $solicitud], 201);
        } else {
            return response()->json(['message' => 'Error al crear la solicitud de trabajo'], 500);
        }
    }

    public function index()
    {
        $solicitudes = SolicitudTrabajo::all(); // Obtén todas las solicitudes de trabajo

        return response()->json($solicitudes);
    }

}
