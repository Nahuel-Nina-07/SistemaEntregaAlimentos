<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alimento;

class AlimentoController extends Controller
{
    public function index()
    {
        $alimentos = Alimento::all();
        return response()->json(['data' => $alimentos]);
    }

    // Almacenar un nuevo alimento en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_alimento' => 'required',
            'descripcion' => 'required',
            'costo' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen_url' => 'required|url',
        ]);

        $alimento = Alimento::create($request->all());

        return response()->json(['message' => 'Alimento agregado exitosamente', 'data' => $alimento], 201);
    }

    // Actualizar un alimento en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_alimento' => 'required',
            'descripcion' => 'required',
            'costo' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen_url' => 'required|url',
        ]);

        $alimento = Alimento::find($id);

        if (!$alimento) {
            return response()->json(['message' => 'Alimento no encontrado'], 404);
        }

        $alimento->update($request->all());

        return response()->json(['message' => 'Alimento actualizado exitosamente', 'data' => $alimento]);
    }

    // Eliminar un alimento de la base de datos
    public function destroy($id)
    {
        $alimento = Alimento::find($id);

        if (!$alimento) {
            return response()->json(['message' => 'Alimento no encontrado'], 404);
        }

        $alimento->delete();

        return response()->json(['message' => 'Alimento eliminado exitosamente']);
    }
}
