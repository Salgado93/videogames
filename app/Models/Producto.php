<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_nombre',
        'producto_imagen',
        'producto_precio',
        'producto_descripcion',
    ];
}
