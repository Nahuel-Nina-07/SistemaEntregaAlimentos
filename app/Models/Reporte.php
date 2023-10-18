<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'repartidor_id',
        'motivo_reporte',
        'fecha_reporte',
        'usuario_id',
    ];

    public function repartidor()
    {
        return $this->belongsTo(DetalleRepartidor::class, 'repartidor_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
