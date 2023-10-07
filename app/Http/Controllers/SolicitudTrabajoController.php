<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class SolicitudTrabajoController extends Controller
{
    public function create()
    {
        return view('formSolicitudes.form_solicitud_trabajo');
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre_solicitante' => 'required|string|max:255',
            'apellido_solicitante' => 'required|string|max:255',
            'correo_electronico_solicitante' => [
                'required',
                'email',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    $existsInTable1 = DB::table('solicitudes_trabajo')
                        ->where('correo_electronico_solicitante', $value)
                        ->exists();
    
                    $existsInTable2 = DB::table('users')
                        ->where('email', $value)
                        ->exists();
    
                    if ($existsInTable1 || $existsInTable2) {
                        $fail('Este correo electrónico ya está en uso en una de las dos tablas.');
                    }
                },
            ],
            'telefono_solicitante' => 'required|string|max:20',
            'edad' => 'required|boolean',
            'vehiculoPropio' => 'required|boolean',
            'tipo_vehiculo' => 'required|string|max:255',
            'imagen_propiedad_vehiculo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ci_numero' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $existsInTable1 = DB::table('solicitudes_trabajo')
                        ->where('ci_numero', $value)
                        ->exists();
    
                    $existsInTable2 = DB::table('detalle_repartidor')
                        ->where('ci_numero', $value)
                        ->exists();
    
                    if ($existsInTable1 || $existsInTable2) {
                        $fail('Este CI ya ha solicitado trabajo en una de las dos tablas.');
                    }
                },
            ],
        ], [
            'correo_electronico_solicitante.unique' => 'Este correo electrónico ya está en uso.',
            'ci_numero.unique' => 'Este CI ya ha solicitado trabajo.',
            // Agrega aquí más mensajes de error personalizados si es necesario.
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('edad') == 0) {
            return redirect()->back()->with('error', 'Debes tener al menos 18 años para registrarte.');
        }

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

    public function index()
    {
        // Retrieve all the solicitud de trabajo records from the database
        $solicitudes = SolicitudTrabajo::all();

        // Pass the data to a view for display
        return view('solicitudes.index', ['solicitudes' => $solicitudes]);
    }
}
