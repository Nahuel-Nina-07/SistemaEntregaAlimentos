<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';

    protected $fillable = [
        'usuario_id',
        'fecha_hora_pedido',
        'latitud',
        'longitud',
        'estado',
        'repartidor_id_aceptado',
        'foto_pedido',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    public function repartidores()
    {
        return $this->belongsToMany(DetalleRepartidor::class, 'repartidores_pedidos', 'pedido_id', 'repartidor_id')
            ->withPivot('estado');
    }

    public function repartidorAceptado()
    {
        return $this->belongsTo(User::class, 'repartidor_id_aceptado');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }
}
