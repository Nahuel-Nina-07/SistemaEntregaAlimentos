<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrarRestaurante;

class registroRestauranteController extends Controller
{
    //
    public function storeUneteR(Request $request)
    {
        $request->validate([
            'tipoNegocio'=>'required|not_in:0',
            'NombreNegocio'=>'required',
            'NumeroContacto' => 'required',
            'CorreoNegocio' => 'required|email',
        ]);

        session()->put('uneteR_data', $request->all());

        // Redirige al usuario al formulario `formR`
        return view('formSolicitudes.form_restaurante');
    }

    public function storeFormR(Request $request)
    {
        if (session()->has('uneteR_data')) {
            // Valida y almacena los datos del segundo formulario en la base de datos
            $request->validate([
                'nombrePropietario' => 'required',
                'ApellidoPropietario' => 'required',
                'CalleNegocio' => 'required',
                'CiudadNegocio' => 'required',
                'categoria' => 'required',
            ]);
    
            // Obtiene los datos del primer formulario de la sesión
            $uneteRData = session('uneteR_data');
    
            // Combina los datos de ambos formularios
            $data = array_merge($uneteRData, $request->all());
    
            // Almacena los datos en la base de datos
            RegistrarRestaurante::create($data);
    
            // Elimina los datos de la sesión
            session()->forget('uneteR_data');
    
            // Redirige al usuario a donde desees después de guardar los datos
            return view('formSolicitudes.unete_restaurante');
        }
    }

    public function verData()
    {
        $solicitudes=RegistrarRestaurante::all();
        return view('solicitudesRestaurantes.informacion')->with('solicitudes',$solicitudes);
    }
}
