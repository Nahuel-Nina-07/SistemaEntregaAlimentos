<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class SolicitudTrabajoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('datos_basicos')) {
            return redirect('/ingresar-basicos');
        }

        return view('formSolicitudes.form_solicitud_trabajo');
    }
    public function guardarEdadNumero(Request $request)
    {
        // Validar los datos del formulario
        // $request->validate([
        //     'nombre_solicitante' => 'required|string|max:255',
        //     'apellido_solicitante' => 'required|string|max:255',
        //     'edad' => 'required|boolean',
        //     'ci_numero'=>'required|string|max:255',
        // ]);
        

        $validator = Validator::make($request->all(), [
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
            'vehiculoPropio' => 'required|boolean',
            'tipo_vehiculo' => 'required|string|max:255',
            'imagen_propiedad_vehiculo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'correo_electronico_solicitante.unique' => 'Este correo electrónico ya está en uso.',
            // Agrega aquí más mensajes de error personalizados si es necesario.
        ]);

        $nombreCi = $request->session()->get('datos_basicos');

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
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
            'nombre_solicitante' => $nombreCi['nombre_solicitante'],
            'apellido_solicitante' => $nombreCi['apellido_solicitante'],
            'correo_electronico_solicitante' => $request->input('correo_electronico_solicitante'),
            'telefono_solicitante' => $request->input('telefono_solicitante'),
            'edad' => $nombreCi['edad'],
            'vehiculoPropio' => $request->input('vehiculoPropio'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
            'imagen_propiedad_vehiculo' => $url, // Asignar la URL de la imagen
            'ci_numero' => $nombreCi['ci_numero'],
        ]);

        $request->session()->forget('datos_basicos');
        // Redirigir a la vista de confirmación o a donde desees
        return redirect('/')->with('success', 'Datos guardados exitosamente');
    }

    // public function index()
    // {
    //     // Retrieve all the solicitud de trabajo records from the database
    //     $solicitudes = SolicitudTrabajo::all();

    //     // Pass the data to a view for display
    //     return view('solicitudes.index', ['solicitudes' => $solicitudes]);
    // }
}
