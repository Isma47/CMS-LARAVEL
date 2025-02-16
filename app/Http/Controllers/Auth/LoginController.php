<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;

class LoginController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        // IMPORTANT: Las instancias están definidas en el AppServiceProvider
        $this->authService = $authService;
    
    }
    
    public function login(Request $request) {

        $request->validate([
            'email'   => 'required|email|unique:users,email',
            'password'=> 'required',
            'captcha' => 'required|captcha',  
        ]);

        //Enviamos el $request al servicio que se encargara de authenticar 
        $response = $this->authService->login($request->only('email', 'password'));

        if ($response['success']) {
            return redirect()->route('dashboard', ['name' => $response['user']->name]);
        }
    
        return back()->withErrors(['email' => 'Credenciales incorrectas'])
        ->withInput();

    }

}
