<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detalles_factura';
    protected $fillable = ['FacturaID', 'DetalleCarritoID', 'ProductoID', 'Cantidad', 'PrecioUnitario'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'FacturaID');
    }

    public function detalleCarrito()
    {
        return $this->belongsTo(DetalleCarrito::class, 'DetalleCarritoID');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ProductoID');
    }
}
