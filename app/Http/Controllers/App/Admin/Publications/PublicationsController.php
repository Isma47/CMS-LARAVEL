<?php

namespace App\Http\Controllers\App\Admin\Publications;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\App\Admin\CategoriesServicie;
use App\Services\App\Admin\PublicationsSevice;
use Illuminate\Validation\ValidationException;



class PublicationsController extends Controller
{

    protected $userPublications;

    protected $categoriesSevicie;

    public function __construct(PublicationsSevice $publicationsService, CategoriesServicie $categoriesService)
    {
        $this->userPublications = $publicationsService;

        $this->categoriesSevicie = $categoriesService;

    }




    //Renderizra el panel para crar la publicacion
    public function createPublicationForm()
    {
        $categories = $this->categoriesSevicie->getCategories();
        return view('app.admin.publications.createPublication', compact('categories'));
    }




    //Se va encargara en la creacion de las publicaciones
    public function createPublication(Request $request)
    {
        try {
            // Pasar datos al servicio, que se encargará de validarlos
            $this->userPublications->createPublication($request->all());

            return redirect()->route('dashboard.admin')->with('success', 'Publicación creada correctamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {


            // Captura errores de validación y los envía a los inputs correspondientes
            return redirect()->back()
                ->withErrors($e->validator->errors()) // Laravel manejará los errores en sus inputs
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al crear la publicación: ' . $e->getMessage()]);
        }
    }



    

    //Panel que nos aydara a administrar todas las publicaciones
    public function indexPublicacions()
    {
        return view('app.admin.publications.panelPublication', [
            'publications' => $this->userPublications->getPublications()
        ]);
    }


    //Muestra el formulario para actualizar
    public function editPublication($id) 
    {
    
        $publication = $this->userPublications->getPublicationById($id);

        // Si la publicación no existe, redirigir con un error
        if (!$publication) {
            return redirect()->route('admin.publications')
                ->withErrors(['error' => 'La publicación no existe o el ID no es válido.']);
        }
    
        return view('app.admin.publications.updatePublication', [
            'publication' => $publication,
            'categories' => $this->categoriesSevicie->getCategories()
        ]); 
    }


    //Actualizar publicaicon


    //Actuzalizar públicacion
    public function updatePublication(Request $request)
    {
        try {
            // Validar que el ID esté presente
            if (!$request->has('id')) {
                return redirect()->back()->withErrors(['error' => 'El ID de la publicación es requerido.']);
            }
    
            // Pasar datos al servicio, que se encargará de validarlos
            $this->userPublications->updatePublication($request->all());
    
            return redirect()->route('dashboard.admin')->with('success', 'Publicación actualizada correctamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        } 
    }
    

  


    //Elimina publicacion seleccioanda
    public function deletePublication(Request $request)
    {
        try {
            // Llamar al servicio para validar y eliminar la publicación
            $this->userPublications->deletePublication($request->all());

            return redirect()->route('admin.publications')->with('success', 'Publicación eliminada correctamente.');
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } 
    }
}
