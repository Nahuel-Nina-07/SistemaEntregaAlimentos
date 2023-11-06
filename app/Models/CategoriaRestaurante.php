<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaRestaurante extends Model
{
    use HasFactory;

    protected $table = 'categorias_restaurantes';

    protected $fillable = [
        'nombre',
        'imagen',
    ];

    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class, 'categoria_id');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
