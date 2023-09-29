<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_alimento',
        'descripcion',
        'costo',
        'stock',
        'imagen_url',
    ];

    public function detallesFactura() {
        return $this->hasMany(DetalleFactura::class);
    }
}
