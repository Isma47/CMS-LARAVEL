<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publications extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'publications';

    // Columnas de la tabla publications
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'categories_id',
    ];


    // Definir si la tabla usa timestamps (created_at, updated_at)
    public $timestamps = true;


    public function sections(): HasMany
    {
        return $this->hasMany(PublicationsSections::class, 'publication_id');
    }

    //Obtner Categoria
    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
}
