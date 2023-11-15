<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;

class ReportesController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with(['usuario', 'repartidor'])->get();

        return view('reportes.index', compact('reportes'));
    }

    public function detalle($id)
    {
        $reporte = Reporte::with(['usuario', 'repartidor'])->findOrFail($id);

        return view('reportes.detalle', compact('reporte'));
    }
}
