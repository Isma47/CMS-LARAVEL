<?php

namespace App\Http\Controllers\App\Admin\Categories;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\App\Admin\CategoriesServicie;




class CategoriesController extends Controller
{


    protected $categoriesService;

    public function __construct(CategoriesServicie $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    // Muestra el formulario para crear categoría
    public function createForm()
    {
        return view('app.admin.categories.createCategories');
    }

    // Registra una nueva categoría
    public function store(Request $request)
    {

        $this->categoriesService->createCategory($request->all());
        return redirect()->route('admin.categories.create')->with('success', 'Categoría creada correctamente.');
    }


    //Todas las acteorias
    public function dashboardCategories()
    {
        return view('app.admin.categories.PanelCategories', [
            'categories' => $this->categoriesService->getCategoriesPage(),
        ]);
    }



    //Actualiza categorias
    public function updateCategories(Request $request)
    {
        try {
            // Llama al servicio para actualizar la categoría
            $this->categoriesService->updateCategory($request->all());
            return redirect()->route('admin.categories')
                ->with('success', 'Categoría actualizada correctamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        } 

    }


    //Entar a vista del forualriode categoria
    public function editCategories($id)
    {
        $category = $this->categoriesService->getCategoryById($id);
    
        if (!$category) {
            return redirect()->route('admin.categories.index')
                ->withErrors(['error' => 'Categoría no encontrada.']);
        }
    
        return view('app.admin.categories.updateCategories', compact('category'));
    }



    //ELiminar
    public function destroy(Request $request)
    {
        // Validar que el ID se envíe correctamente
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        try {
            $result = $this->categoriesService->deleteCategory($validated['id']);
            return redirect()->route('admin.categories.index')->with('delete', 'Categoría eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al eliminar la categoría: ' . $e->getMessage()]);
        }
    }
    
}
