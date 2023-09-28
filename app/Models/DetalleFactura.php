<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    public function factura() {
        return $this->belongsTo(Factura::class);
    }

    public function alimento() {
        return $this->belongsTo(Alimento::class);
    }
}
