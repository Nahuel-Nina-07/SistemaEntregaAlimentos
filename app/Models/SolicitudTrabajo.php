<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudTrabajo extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_trabajo';

    protected $fillable = [
        'fecha_solicitud',
        'nombre_solicitante',
        'apellido_solicitante',
        'correo_electronico_solicitante',
        'telefono_solicitante',
        'edad',
        'vehiculoPropio',
        'tipo_vehiculo',
        'imagen_propiedad_vehiculo',
        'imagen_repartidor',
        'ci_numero',
        'estadoSolicitud',
        'Placa_vehiculo',
        'password',
    ];
}
