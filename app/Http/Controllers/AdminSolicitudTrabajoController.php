<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudTrabajo;
use App\Models\User;
use App\Models\DetalleRepartidor;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordLinkSentNotification;
use App\Notifications\ResetPasswordRejectedNotification;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Mail\ContactanosMailble;

class AdminSolicitudTrabajoController extends Controller
{
    public function index($estado = 'todos')
    {
        if ($estado === 'todos') {
            $solicitudes = SolicitudTrabajo::select('id', 'imagen_repartidor', 'nombre_solicitante')->get();
        } else {
            $estadoSolicitud = 0; // Por defecto, pendientes
            if ($estado === 'aceptados') {
                $estadoSolicitud = 1;
            } elseif ($estado === 'rechazados') {
                $estadoSolicitud = 2;
            }

            $solicitudes = SolicitudTrabajo::select('id', 'imagen_repartidor', 'nombre_solicitante')
                ->where('estadoSolicitud', $estadoSolicitud)
                ->get();
        }

        $aceptados = SolicitudTrabajo::where('estadoSolicitud', 1)->get();
        $pendientes = SolicitudTrabajo::where('estadoSolicitud', 0)->get();
        $rechazados = SolicitudTrabajo::where('estadoSolicitud', 2)->get();

        // Pasar los datos a la vista
        return view('solicitudes.index', compact('solicitudes', 'aceptados', 'pendientes', 'rechazados'));
    }

    public function verSolicitudesAceptadas($id)
    {
        // Aquí puedes cargar la solicitud específica con el ID y pasarla a la vista de 'solicitudesAceptadas'
        $solicitud = SolicitudTrabajo::find($id);

        // Luego, pasa la solicitud a la vista
        return view('solicitudes.solicitudesAceptadas', compact('solicitud'));
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


        if (request()->isMethod('post')) {
            if (request()->has('aceptar')) {
                $solicitud->update(['estadoSolicitud' => true]);
                $user = User::create([
                    'name' => $solicitud->nombre_solicitante,
                    'apellido' => $solicitud->apellido_solicitante,
                    'email' => $solicitud->correo_electronico_solicitante,
                    'profile_photo_path' => str_replace('/storage/images/', 'profile-photos/', $solicitud->imagen_repartidor),
                ]);
                $detalleRepartidor = DetalleRepartidor::create([
                    'repartidor_id' => $user->id, // Usamos el ID del usuario creado
                    'fecha_incorporacion' => now(), // Fecha actual
                    'ci_numero' => $solicitud->ci_numero, // Copiamos el CI desde la solicitud
                    'edad' => $solicitud->edad,
                    'tipo_vehiculo' => $solicitud->tipo_vehiculo,
                    'telefono' => $solicitud->telefono_solicitante,
                    'imagen_propiedad_vehiculo' => $solicitud->imagen_propiedad_vehiculo,
                    'reportado' => false, // Valor por defecto
                    'vehiculoPropio' => $solicitud->vehiculoPropio, // Copiamos el valor de la solicitud
                    'Placa_vehiculo' => $solicitud->Placa_vehiculo,
                ]);

                $repartidorRole = Role::where('name', 'repartidor')->first(); // Asegúrate de que 'repartidor' sea el nombre correcto del rol
                if ($repartidorRole) {
                    $user->assignRole($repartidorRole);
                }

                $token = Password::createToken($user);
                $user->notify(new ResetPasswordLinkSentNotification($token));
            } elseif (request()->has('rechazar')) {
                // Si se ha enviado una solicitud POST y se ha hecho clic en el botón "Rechazar"
                // Actualiza el estado de la solicitud a 2
                $solicitud->update(['estadoSolicitud' => 2]);

                $correoSolicitante = $solicitud->correo_electronico_solicitante;
                $user = new User();
                $user->email = $correoSolicitante;
                $user->notify(new ResetPasswordRejectedNotification);
                // Mail::to($solicitud->correo_electronico_solicitante)->send(new ContactanosMailble());
            }
            // Redirige al usuario a la ruta admin.solicitudes
            return redirect()->route('admin.solicitudes');
        }

        return view('solicitudes.show', compact('solicitud'));
    }
}
