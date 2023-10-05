<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrarRestaurante extends Model
{
    use HasFactory;

    protected $table = 'registrar_restaurantes';

    protected $fillable = [
        'tipoNegocio',
        'NombreNegocio',
        'NumeroContacto',
        'CorreoNegocio',
        'nombrePropietario',
        'ApellidoPropietario',
        'CalleNegocio',
        'CiudadNegocio',
        'categoria',
    ];

}
