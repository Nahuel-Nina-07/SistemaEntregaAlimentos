<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;

class AdminSolicitudTrabajoController extends Controller
{
    public function index()
    {
        // Retrieve only the image and name columns of solicitud de trabajo records from the database
        $solicitudes = SolicitudTrabajo::select('id','imagen_propiedad_vehiculo', 'nombre_solicitante')->get();

        // Pass the data to a view for display
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function show($id)
    {
        // Retrieve the solicitud de trabajo record by its ID
        $solicitud = SolicitudTrabajo::find($id);

        // Check if the solicitud exists
        if (!$solicitud) {
            // Handle the case where the solicitud was not found, for example, redirect to a 404 page
            abort(404);
        }

        // Pass the data to a view for display
        return view('solicitudes.show', compact('solicitud'));
    }
}
