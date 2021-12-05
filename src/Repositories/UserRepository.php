<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
   protected $userModel;

   public function __construct(User $user)
   {
       $this->userModel = $user;
   }

   public function getAllUsers()
   {    
        return User::all();
   }

   public function getUserById($id)
   {
       return $this->userModel->findOrFail($id);
   }

}