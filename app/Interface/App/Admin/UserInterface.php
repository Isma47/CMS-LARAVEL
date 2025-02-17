<?php
namespace App\Interface\App\Admin;

use App\Models\User;




interface UserInterface {

    public function createUser(array $requets) :  User; 


    public function getDataUser();

    public function getUserById(int $userId) : User;


    public function deleteUser(int $userId) : void;
}