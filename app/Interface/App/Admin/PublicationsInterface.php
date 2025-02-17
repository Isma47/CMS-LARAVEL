<?php
namespace App\Interface\App\Admin;

use App\Models\Publications;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface PublicationsInterface {


    public function  createPublication(array  $request) : Publications;


    public function getPublications(): LengthAwarePaginator;


    public function updatePublication(array $request): Publications;

    
    public function deletePublication(array $data): void;


}