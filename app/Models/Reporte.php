<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['user_id', 'repartidor_id', 'motivo'];

    // Relación con el usuario que realizó el reporte
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el repartidor reportado
    public function repartidor()
    {
        return $this->belongsTo(User::class, 'repartidor_id');
    }
}
