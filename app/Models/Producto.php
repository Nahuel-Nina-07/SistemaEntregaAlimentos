<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = ['NombreProducto', 'Descripcion', 'Precio', 'Stock', 'Imagen', 'RestauranteID', 'CategoriaID'];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'RestauranteID');
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaProducto::class, 'CategoriaID');
    }
}
