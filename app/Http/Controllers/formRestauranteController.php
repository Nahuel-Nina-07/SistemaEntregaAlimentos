<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\RegistrarRestaurante;
class formRestauranteController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('unete')) {
            return redirect('/uneteRestaurante');
        }

        return view('formSolicitudes.form_restaurante');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombrePropietario' => 'required|string|max:255',
            'ApellidoPropietario' => 'required|string|max:255',
            'CalleNegocio	' => 'required|string|max:255',
            'CiudadNegocio' => 'required|string|max:255',
            'LogoImg	' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $unete = $request->session()->get('unete');

        // if ($validator->fails()) {
        //     return Redirect::back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        if ($request->hasFile('LogoImg')) {
            $imagePath = $request->file('LogoImg')->store('public/images');
            $url = Storage::url($imagePath);
        } else {
            return redirect()->back()->with('error', 'Debe cargar una imagen.'); // Si no se proporciona una imagen
        }

        RegistrarRestaurante::create([
            'tipoNegocio' => $unete['tipoNegocio'],
            'NombreNegocio' => $unete['NombreNegocio'],
            'nombrePropietario' => $request->input('nombrePropietario'),
            'ApellidoPropietario' => $request->input('ApellidoPropietario'),
            'NumeroContacto' => $unete['NumeroContacto'],
            'CalleNegocio' => $request->input('CalleNegocio'),
            'LogoImg' => $url, // Asignar la URL de la imagen
            'CorreoNegocio' => $unete['CorreoNegocio'],
            'CiudadNegocio' => $request->input('CiudadNegocio'),
        ]);

        $request->session()->forget('unete');
        return redirect('/');
    }
}
