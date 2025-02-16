<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Interface\Auth\AuthInterface;


class AuthService implements AuthInterface {

    public function login(array $credentials) : array
    {
        
        if (Auth::attempt($credentials)) {
            
            session()->regenerate();

            $user = Auth::user();

            return ['success' => true, 'user' => Auth::user()];

        }


        return ['success' => false];
    }

}