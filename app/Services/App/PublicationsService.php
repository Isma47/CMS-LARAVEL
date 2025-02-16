<?php

namespace App\Services\App;

use App\Models\Categories;
use App\Models\Publications;
use Illuminate\Database\Eloquent\Collection;
use App\Interface\App\PublicationsInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;




class PublicationsService implements PublicationsInterface
{


    //Obtenr todas las publicaciones
    public function getPublications(): Paginator
    {
        //Obtenemos la paginación y la retonaremos en la vista.

        $publications = Publications::paginate(8);

        return $publications;
    }


    //Traer categorias disponibles

    public function getCategories(): Collection
    {
        return Categories::all();
    }




    //Obtener la publicación seleccionada
    public function getPublication(int $id): object
    {
        try {
            // Buscar la publicación, si no existe, lanza un error 404
            $publication = Publications::findOrFail($id);

            //Filtramos y buscamos el orden de los subtemas de la publicación
            $publication->sections = $publication->sections()->orderBy('order', 'asc')->get();

            return $publication;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            // Si la publicación no existe, devolver una respuesta con error 404
            abort(404, 'Publicación no encontrada');
        }
    }



    //Obtener información filtradaa por categoria
    public function getPublicationCategorie(array $categories): Builder
    {
        return Publications::whereIn('categories_id', $categories);
    }
    
}
