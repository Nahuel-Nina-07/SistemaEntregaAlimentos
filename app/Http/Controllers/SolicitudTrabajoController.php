<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;
use Illuminate\Support\Facades\Storage;

class SolicitudTrabajoController extends Controller
{
    public function create()
    {
        return view('formSolicitudes.form_solicitud_trabajo');
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_solicitante' => 'required|string|max:255',
            'apellido_solicitante' => 'required|string|max:255',
            'correo_electronico_solicitante' => 'required|email|max:255',
            'telefono_solicitante' => 'required|string|max:20',
            'edad' => 'required|boolean',
            'vehiculoPropio' => 'required|boolean',
            'tipo_vehiculo' => 'required|string|max:255',
            'imagen_propiedad_vehiculo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ci_numero' => 'required|integer',
        ]);

        // Crear una nueva solicitud de trabajo en la base de datos

        if ($request->hasFile('imagen_propiedad_vehiculo')) {
            $imagePath = $request->file('imagen_propiedad_vehiculo')->store('public/images');
            $url = Storage::url($imagePath);
        } else {
            return redirect()->back()->with('error', 'Debe cargar una imagen.'); // Si no se proporciona una imagen
        }
    
        // Crear una nueva solicitud de trabajo en la base de datos
        SolicitudTrabajo::create([
            'nombre_solicitante' => $request->input('nombre_solicitante'),
            'apellido_solicitante' => $request->input('apellido_solicitante'),
            'correo_electronico_solicitante' => $request->input('correo_electronico_solicitante'),
            'telefono_solicitante' => $request->input('telefono_solicitante'),
            'edad' => $request->input('edad'),
            'vehiculoPropio' => $request->input('vehiculoPropio'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
            'imagen_propiedad_vehiculo' => $url, // Asignar la URL de la imagen
            'ci_numero' => $request->input('ci_numero'),
        ]);
        // Redirigir a la vista de confirmación o a donde desees
        return redirect()->route('repartidor.create');
    }
}
