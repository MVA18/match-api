<?php

namespace App\Actions;

use App\Repositories\UserRepository;

class UserAction
{
   protected $userRepository;

   public function __construct(UserRepository $userRepository)
   {
       $this->userRepository = $userRepository;
   }

   public function getUser($id)
   {
       $user = $this->userRepository->getUserById($id);
       return $user;
   }
}