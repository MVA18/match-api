<?php

namespace App\Data;

class CreateRandomUserData 
{
    public function data()
    {
        $faker = \Faker\Factory::create();
        $genders = ['male','female'];
        $gender = $genders[array_rand($genders, 1)];

        return (object)
        [
            'gender'    => $gender,
            'name'      => $faker->name($gender),
            'email'     => $faker->email,
            'password'  => '12345678',
            'age'       => rand(18,100)
        ];
    }
    
}