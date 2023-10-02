<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $fillable = ['ClienteID', 'FechaHoraFactura', 'TotalFactura'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ClienteID');
    }

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'FacturaID');
    }
}
