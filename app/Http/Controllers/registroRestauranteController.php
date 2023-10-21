<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrarRestaurante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class registroRestauranteController extends Controller
{
    public function index()
    {
        $categoriasRestaurantes = DB::table('categorias_restaurantes')->pluck('nombre', 'id');
        return view('formSolicitudes.form_negocio_uno', compact('categoriasRestaurantes'));
    }
    
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tipoNegocio'=>'required|string|max:255',
            'NombreNegocio'=>'required',
            function ($attribute, $value, $fail) use ($request) {
                $existsInTable1 = DB::table('restaurantes')
                    ->where('nombre', $value)
                    ->exists();

                $existsInTable2 = DB::table('registrar_restaurantes')
                    ->where('NombreNegocio', $value)
                    ->exists();

                if ($existsInTable1 || $existsInTable2) {
                    $fail('Este megocio ya existe');
                }
            },
            'NumeroContacto' => 'required',
            'CorreoNegocio' => 'required|email',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        //
        $request->session()->put('unete', [
            'tipoNegocio' => $request->input('tipoNegocio'),
            'NombreNegocio' => $request->input('NombreNegocio'),
            'NumeroContacto' => $request->input('NumeroContacto'),
            'CorreoNegocio' => $request->input('CorreoNegocio'),
        ]);

        return redirect('/formRestaurante');
    }
}
