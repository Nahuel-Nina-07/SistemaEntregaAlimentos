<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPassword;
class Restaurante extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'restaurantes';

    protected $fillable = [
        'fecha_incorporacion',
        'nombre',
        'direccion',
        'categoria_id',
        'telefono',
        'CalleNegocio',
        'CiudadNegocio',
        'correo_electronico',
        'imagen',
        'nombrePropietario',
        'ApellidoPropietario',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaRestaurante::class, 'categoria_id');
    }
}
