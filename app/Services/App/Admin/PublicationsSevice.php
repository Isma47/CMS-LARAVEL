<?php

namespace App\Services\App\Admin;

use App\Models\Categories;
use App\Models\Publications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use App\Interface\App\Admin\PublicationsInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PublicationsSevice implements PublicationsInterface
{

    //Crear
    public function createPublication(array $request): Publications
    {
        // Validar los datos, incluyendo que se envíe la imagen
        $validated = Validator::make($request, [
            'title'         => ['required', 'string', 'max:50'],
            'description'   => ['required', 'string', 'max:255'],
            'categories_id' => ['required', 'integer', 'exists:categories,id'],
            'image'         => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'] // Imagen requerida
        ])->validate();

        // Procesar y almacenar la imagen con un nombre único generado por hash
        $image = $validated['image'];
        $hashName = md5(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();


        // Guardar la imagen en el disco public, en la carpeta publications
        $image->storeAs('publications', $hashName, 'public');

        // Crear y devolver la publicación
        return Publications::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => Auth::id(),
            'categories_id' => $validated['categories_id'],
            'name_img' => $hashName, // Se guarda el nombre único de la imagen
        ]);
    }



    //Recuperar todas las publicaciones
    public function getPublications(): LengthAwarePaginator
    {
        return Publications::paginate(10);
    }




    //Actualziar publicacion
    public function updatePublication(array $data): Publications
    {
        // Validar los datos antes de actualizar
        $rules = [
            'id'             => ['required', 'integer', 'exists:publications,id'],
            'title'          => ['required', 'string', 'max:50'],
            'description'    => ['required', 'string', 'max:255'],
            'categories_id'  => ['required', 'integer', 'exists:categories,id'],
        ];
    
        // Si se envía una nueva imagen, agregar reglas de validación
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }
    
        $validated = Validator::make($data, $rules)->validate();
    
        // Buscar la publicación
        $publication = Publications::findOrFail($validated['id']);
    
        // Preparar los datos a actualizar
        $updateData = [
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'categories_id' => $validated['categories_id'],
        ];
    
        // Si se envía una nueva imagen, procesarla
        if (isset($validated['image'])) {
            // Si ya existe una imagen, eliminarla del storage
            if ($publication->name_img && Storage::disk('public')->exists('publications/' . $publication->name_img)) {
                Storage::disk('public')->delete('publications/' . $publication->name_img);
            }
            // Generar un nombre único para la nueva imagen
            $image = $validated['image'];
            $hashName = md5(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            // Guardar la imagen en la carpeta 'publications' en el disco 'public'
            $image->storeAs('publications', $hashName, 'public');
            // Actualizar el nombre de la imagen en la publicación
            $updateData['name_img'] = $hashName;
        }
    
        // Actualizar la publicación
        $publication->update($updateData);
    
        return $publication;
    }









    //Eliminar publicacion

    public function deletePublication(array $data): void
    {
        // Validar que el ID sea válido y exista en la base de datos
        $validated = Validator::make($data, [
            'id' => ['required', 'integer', 'exists:publications,id']
        ])->validate();

        // Buscar la publicación
        $publication = Publications::findOrFail($validated['id']);


        // Eliminar la publicación
        $publication->delete();
    }



    public function getPublicationById($id): ?Publications
    {
        // Validar el ID con Laravel Validator
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'integer', 'exists:publications,id']
        ]);

        // Si la validación falla, retornamos null
        if ($validator->fails()) {
            return null;
        }

        // Intentar encontrar la publicación, si no existe retornamos null
        return Publications::find($id);
    }
}
