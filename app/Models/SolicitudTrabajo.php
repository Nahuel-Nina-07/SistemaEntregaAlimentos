<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_solicitud',
        'nombre_solicitante',
        'correo_electronico_solicitante',
        'telefono_solicitante',
        'detalles_solicitud',
        'edad',
        'tipo_vehiculo',
        'imagen_propiedad_vehiculo',
        'ci_numero',
        'numero_placa',
    ];
}
