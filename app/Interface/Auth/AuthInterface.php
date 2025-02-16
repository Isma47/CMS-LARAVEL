<?php

namespace App\Interface\Auth;


Interface AuthInterface {
    
    public function login(array $credentials) : array;


}
