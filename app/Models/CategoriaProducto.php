<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    use HasFactory;

    protected $table = 'categorias_productos';

    protected $fillable = [
        'nombre',
        'imagen',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id'); // Asegúrate de que 'categoria_id' coincida con el nombre de la clave foránea en tu tabla 'productos'
    }
}
