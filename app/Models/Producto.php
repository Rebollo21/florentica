<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_ramo',
        'descripcion',
        'precio_venta',
        'categoria',
        'imagen_url',
        'activo'
    ];
}