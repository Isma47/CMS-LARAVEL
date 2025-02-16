<?php
namespace App\Interface\App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;


interface PublicationsInterface {

    public function getPublications() : Paginator;

    public function getCategories() : Collection;

    public function getPublication(int $id) : object;

    public function getPublicationCategorie(array $categories): Builder;
}