<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoCompra extends Model
{
    use HasFactory;

    protected $table = 'carritos_compras';
    protected $fillable = ['ClienteID', 'FechaHoraCreacion'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ClienteID');
    }

    public function detallesCarrito()
    {
        return $this->hasMany(DetalleCarrito::class, 'CarritoID');
    }
}
