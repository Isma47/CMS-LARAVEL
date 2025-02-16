<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'categories';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'categories_id',
    ];

    // Definir si la tabla usa timestamps (created_at, updated_at)
    public $timestamps = true;

}
