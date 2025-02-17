<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            'email'   => 'required|email',
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



    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida la sesión actual
        $request->session()->invalidate();

        // Regenera el token CSRF para mayor seguridad
        $request->session()->regenerateToken();

        // Redirige al login o a la página principal con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

}
