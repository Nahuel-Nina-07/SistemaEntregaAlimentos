<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\SolicitudTrabajo;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class SolicitudTrabajoBasicoController extends Controller
{
    public function index(Request $request)
    {
        return view('formSolicitudes.form_solicitud_trabajo_uno');
    }
    public function guardarNombreCi(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre_solicitante' => 'required|string|max:255',
            'apellido_solicitante' => 'required|string|max:255',
            'edad' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value == 0) {
                        $fail('Necesitamos que seas mayor de edad');
                    }
                },
            ],
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
                        $fail('Este CI ya ha solicitado empleo');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $request->session()->put('datos_basicos', [
            'nombre_solicitante' => $request->input('nombre_solicitante'),
            'apellido_solicitante' => $request->input('apellido_solicitante'),
            'edad' => $request->input('edad'),
            'ci_numero' => $request->input('ci_numero'),
        ]);

        return redirect('/ingresar-detallados');
    }
}
