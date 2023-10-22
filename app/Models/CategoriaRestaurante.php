<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaRestaurante extends Model
{
    use HasFactory;

    protected $table = 'categorias_restaurantes';

    protected $fillable = [
        'id',
        'nombre',
        'imagen',
    ];
}
