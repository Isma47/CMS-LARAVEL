<?php

namespace App\Services\App\Admin;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use App\Interface\App\Admin\CategoriesInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class CategoriesServicie implements CategoriesInterface
{


    //Obtenrlas categoria
    public function getCategories(): Collection
    {
        return Categories::all();
    }


    //Pagiancion d elo servicios
    public function getCategoriesPage(): LengthAwarePaginator
    {
        return Categories::paginate(10); // Pagina 10 elementos por página
    }





    public function createCategory(array $data): Categories
    {
        $validated = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255']
        ])->validate();

        return Categories::create([
            'nameCategorie' => $validated['title'],
            'description'  => $validated['description'],
            'status' => 1,
        ]);
    }





    //Obtiens la categoria seleccionada
    public function getCategoryById(int $id): ?Categories
    {
        return Categories::find($id);
    }




    //actualizar categoria
    public function updateCategory(array $data): Categories
    {
        $validated = Validator::make($data, [
            'id'  => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validate();

        $category = Categories::findOrFail($validated['id']);

        $category->update([
            'nameCategorie' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return $category;
    }



    //Eliminar
    public function deleteCategory(int $id): bool
    {
        $category = Categories::findOrFail($id);
        return $category->delete();
    }
    
}
