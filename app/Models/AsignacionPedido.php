<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionPedido extends Model
{
    use HasFactory;

    protected $table = 'asignacion_pedidos';
    protected $fillable = ['pedido_id', 'repartidor_id', 'estado_asignacion'];

    // Relación con el modelo de Pedidos
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    // Relación con el modelo de Repartidores (Users)
    public function repartidor()
    {
        return $this->belongsTo(User::class, 'repartidor_id');
    }
}
