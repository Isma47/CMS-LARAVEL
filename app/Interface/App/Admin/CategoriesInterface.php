<?php
namespace App\Interface\App\Admin;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface CategoriesInterface {



    public function getCategories(): Collection ;

    public function getCategoriesPage() : LengthAwarePaginator;
    
    public function updateCategory(array $data): Categories;

    public function getCategoryById(int $id): ?Categories;


    public function createCategory(array $data): Categories;


    public function deleteCategory(int $id): bool;


}