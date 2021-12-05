<?php

namespace App\Actions;

use App\Models\User;

class createUserAction
{
   public function create($userData)
   {
       $user = User::create([
            'name'      => $userData->name,
            'email'     => $userData->email,
            'password'  => $userData->password,
            'gender'    => $userData->gender,
            'age'       => $userData->age,
        ]);

    return $user;
   }
}