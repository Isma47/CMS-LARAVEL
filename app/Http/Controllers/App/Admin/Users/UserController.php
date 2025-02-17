<?php

namespace App\Http\Controllers\App\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\App\Admin\UserServicie;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{

    protected $userService;

    public function __construct(UserServicie $userService)
    {
        $this->userService = $userService;
    }

    public function createUser()
    {
        return view('app.admin.users.createUser');
    }



    public function registerUser(Request $request)
    {
        try {
            // Pasar datos al servicio, que se encargará de validarlos
            $this->userService->createUser($request->all());

            return redirect()->route('dashboard.admin')->with('success', 'Usuario registrado correctamente');
        } catch (ValidationException $e) {

            // Si la validación falla, obtenemos errores individuales y los enviamos con withErrors()
            return redirect()->back()
                ->withErrors($e->validator->errors()) // Laravel manejará cada error en su input correspondiente
                ->withInput();
        }
    }







    public function adminUser()
    {
        $getUsers = $this->userService->getDataUser();

        return view('app.admin.users.panelUsers', ['users' => $getUsers]);
    }

    public function getFormUser($id)
    {
        try {
            // Obtener usuario desde el servicio
            $user = $this->userService->getUserById($id);

            return view('app.admin.users.actualizarUsuario', compact('user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            // Si el usuario no existe, redirige al dashboard de admin
            return redirect()->route('dashboard.admin')->withErrors(['error' => 'Usuario no encontrado.']);
        }
    }


    public function updateUser(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'id' => ['required', 'integer', 'exists:users,id'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
                'role' => ['required', 'string', 'in:admin,user']
            ]);
    
            // Llamar al servicio para actualizar
            $this->userService->updateUser($validatedData['id'], $validatedData);
    
            return redirect()->route('admin.updateUser')->with('success', 'Usuario actualizado correctamente.');
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        } 

    }
    





    public function deleteUsers(Request $request)
    {

        // Validar que el ID del usuario sea válido y exista
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:users,id']
        ]);


        try {
            // Delegar la eliminación al servicio
            $this->userService->deleteUser($validated['id']);

            return redirect()->route('admin.updateUser')->with('delete', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'No se pudo eliminar el usuario.']);
        }
    }
}
