<?php

namespace App\Models;

use App\Models\Publications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicationsSections extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'publications_sections';

    
    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'publication_id',
    ];


    // Definir si la tabla usa timestamps (created_at, updated_at)
    public $timestamps = true;


    //Cada sección pertenece a una publicación
    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publications::class, 'publication_id');
    }
}
