<?php

namespace App\Services\App\Admin;

use App\Interface\App\Admin\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserServicie implements UserInterface
{


    public function createUser(array $data): User
    {
        // Validar los datos antes de guardarlos
        $validated = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,user']
        ])->validate();

        // Crear y devolver el usuario
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Encripta la contraseña
            'role' => $validated['role'],
        ]);
    }


    public function getDataUser()
    {
        return User::paginate(10);
    }


    public function getUserById(int $userId): User
    {
        return User::findOrFail($userId);
    }

    public function updateUser(int $id, array $data)
    {
        // Validar los datos antes de guardarlos
        $validated = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8'], // Permite campo vacío
            'role' => ['required', 'string', 'in:admin,user']
        ])->validate();
    

        
        // Buscar el usuario
        $user = User::findOrFail($id);
    
        // Crear un array con los campos que van a ser actualizados
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role']
        ];
    
        // Si la contraseña no está vacía, la encripta y la actualiza
        if (!empty($validated['password'])) {
            $updateData['password'] = bcrypt($validated['password']);
        }
    
        // Actualizar solo los campos modificados
        $user->update($updateData);
    }
    



    public function deleteUser(int $userId): void
    {
        // Buscar el usuario y eliminarlo
        $user = User::findOrFail($userId);
        $user->delete();
    }
}
