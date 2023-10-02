<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'detalles_carrito';
    protected $fillable = ['CarritoID', 'ProductoID', 'Cantidad'];

    public function carrito()
    {
        return $this->belongsTo(CarritoCompra::class, 'CarritoID');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ProductoID');
    }
}
