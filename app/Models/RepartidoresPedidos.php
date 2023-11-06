<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepartidoresPedidos extends Model
{
    use HasFactory;
    protected $table = 'repartidores_pedidos';

    protected $fillable = [
        'repartidor_id',
        'pedido_id',
        'estado',
    ];
    public function repartidores(){
        return $this->belongsTo(DetalleRepartidor::class, 'repartidor_id');
    }

    public function pedidos(){
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
