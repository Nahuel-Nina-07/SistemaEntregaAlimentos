<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRepartidor extends Model
{
    use HasFactory;

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
    ];

    public function repartidor()
    {
        return $this->belongsTo(Usuario::class, 'repartidor_id');
    }
}
