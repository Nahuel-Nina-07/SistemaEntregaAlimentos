<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'estado',
        'fecha_actualizacion',
        'detalles_repartidor_id',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function detallesRepartidor()
    {
        return $this->belongsTo(DetalleRepartidor::class, 'detalles_repartidor_id');
    }
}
