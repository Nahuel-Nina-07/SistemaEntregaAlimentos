<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // En el modelo User (Repartidor)
public function asignacionPedidos()
{
    return $this->hasMany(AsignacionPedido::class, 'repartidor_id');
}

public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class, 'repartidor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'repartidor_id');
    }

}
