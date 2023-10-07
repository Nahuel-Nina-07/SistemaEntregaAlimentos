<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;

class AdminSolicitudTrabajoController extends Controller
{
    public function index()
    {
        // Retrieve all the solicitud de trabajo records from the database
        $solicitudes = SolicitudTrabajo::all();

        // Pass the data to a view for display
        return view('solicitudes.index', compact('solicitudes'));
    }
}
