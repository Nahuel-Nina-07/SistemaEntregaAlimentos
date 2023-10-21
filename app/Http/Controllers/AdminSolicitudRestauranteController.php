<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrarRestaurante;
use App\Models\Restaurante;
use App\Models\CategoriaRestaurante;

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

    public function verSolicitudesAceptadas($id)
    {
        // Aquí puedes cargar la solicitud específica con el ID y pasarla a la vista de 'solicitudesAceptadas'
        $solicitud = RegistrarRestaurante::find($id);

        // Luego, pasa la solicitud a la vista
        return view('solicitudes.solicitudesAceptadasRestaurante', compact('solicitud'));
    }

    public function show($id)
    {
        // Retrieve the solicitud de trabajo record by its ID
        $solicitud = RegistrarRestaurante::find($id);

        // Check if the solicitud exists
        if (!$solicitud) {
            // Handle the case where the solicitud was not found, for example, redirect to a 404 page
            abort(404);
        }


        if (request()->isMethod('post')) {
            if (request()->has('aceptar')) {
                $categoria = CategoriaRestaurante::where('nombre', $solicitud->tipoNegocio)->first();
                $solicitud->update(['estadoSolicitud' => true]);
                if ($categoria) {
                    // Encuentra la categoría y obtén su id
                    $categoriaId = $categoria->id;
        
                    // Crea el restaurante utilizando el id de la categoría
                    $user = Restaurante::create([
                        'fecha_incorporacion' => now(),
                        'nombre' => $solicitud->NombreNegocio,
                        'direccion' => $solicitud->apellido_solicitante,
                        'categoria_id' => $categoriaId,
                        'telefono' => $solicitud->NumeroContacto,
                        'CalleNegocio' => $solicitud->CalleNegocio,
                        'CiudadNegocio' => $solicitud->CiudadNegocio,
                        'correo_electronico' => $solicitud->CorreoNegocio,
                        'nombrePropietario' => $solicitud->nombrePropietario,
                        'ApellidoPropietario' => $solicitud->ApellidoPropietario,
                        'imagen' => str_replace('/storage/images/', 'profile-photos/', $solicitud->LogoImg),
                    ]);
                } else {
                    // Maneja el caso en el que la categoría no se encontró
                    // Puedes mostrar un mensaje de error o tomar medidas apropiadas.
                }
            } elseif (request()->has('rechazar')) {
                // Si se ha enviado una solicitud POST y se ha hecho clic en el botón "Rechazar"
                // Actualiza el estado de la solicitud a 2
                $solicitud->update(['estadoSolicitud' => 2]);
            }
            // Redirige al usuario a la ruta admin.solicitudes
            return redirect()->route('admin.solicitudesRestaurantes');
        }

        return view('restaurantes.show', compact('solicitud'));
    }
}
