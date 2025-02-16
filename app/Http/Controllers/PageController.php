<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\App\PublicationsService;
use App\Http\Controllers\App\PublicationsController;

class PageController extends Controller
{

    //Login
    public function login()
    {
        return view('auth.login');
    }



    //Dahsboad publico para ver las publicaciones
    public function dashboard(PublicationsService $publicationsService)
    {


        return view('app.dashboard',  [
            'categories' => $publicationsService->getCategories(),
            'paginatePublications' => $publicationsService->getPublications()
        ]);
    }




    //Obtengo la información filtrada de las categorias selecciondas por el usuarip
    public function getPublicationCategorie(PublicationsService $publicationsService, Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'action' => 'required|string|in:Eliminar categorias,Obtener resultados',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id'
        ]);

        $action = $validated['action'];
        $categories = $validated['categories'] ?? [];

        
        // Si se presionó el botón Eliminar redirigir al dashboard
        if ($action === 'Eliminar categorias') {
            return redirect()->route('dashboard');
        }


        // Si se presionó Obtener resultados filtrar por categorías
        $publicationsCategory = $publicationsService->getPublicationCategorie($categories)->paginate(8);


        //Enviamos ala vista la ifnromación de la actegoria, se utulizaron als relaciones de laravel para mostrar las categorias 
        return view('app.dashboard', [
            'categories' => $publicationsService->getCategories(),
            'paginatePublications' => $publicationsCategory,
            'selectedCategories' => $categories
        ]);
    }










    //Obtiene a información del articulo seleccionado 
    public function publication(PublicationsService $publicationsService, $id)
    {

        return view('app.publication',  [
            'publication' => $publicationsService->getPublication($id)
        ]);
    }
}
