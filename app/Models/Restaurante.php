<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'nombre',
        'direccion',
        'categoria_id',
        'telefono',
        'correo_electronico',
        'imagen',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaRestaurante::class, 'categoria_id');
    }
}
