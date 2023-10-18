<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRepartidor extends Model
{
    use HasFactory;

    protected $table = 'detalle_repartidor';
    protected $fillable = [
        'repartidor_id',
        'fecha_incorporacion',
        'ci_numero',
        'numero_placa',
        'edad',
        'tipo_vehiculo',
        'telefono',
        'imagen_propiedad_vehiculo',
        'reportado',
        'Placa_vehiculo',
        'vehiculoPropio',
    ];

    public function repartidor()
    {
        return $this->belongsTo(User::class, 'repartidor_id');
    }
}
