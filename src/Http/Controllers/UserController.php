<?php

namespace App\Http\Controllers;

use App\config\DB;
use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    public function create(Request $request, Response $response)
    {
        $faker = \Faker\Factory::create();

        $genders = ['male','female'];

        $gender = $genders[array_rand($genders, 1)];
        $name = $faker->name($gender);
        $email = $faker->email;
        $password = '12345678';
        
        $age = rand(18,100);

        $sql = "INSERT INTO users (email, password, name, gender, age) VALUES(:email, :password, :name, :gender, :age)";

        try
        {
            $db = new DB();
            $db = $db->connect();

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':age', $age);

            $stmt->execute();

            $last_id = $db->lastInsertId();

            $sql = "SELECT * FROM users WHERE id = $last_id";
            $stmt = $db->query($sql);
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $db = null;

            $response->getBody()->write(json_encode($user));
            return $response;
        }
        catch(PDOException $e)
        {
            echo '{"error"}: {"text": '.$e->getMessage().'}';
        }
    }

    public function profiles(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');
        $id = ($id) ? $id : null;

        $sql = "SELECT * FROM users WHERE id <> $id";

        try
        {
            $db = new db();
            $db = $db->connect();

            $stmt = $db->query($sql);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);

            $db = null;

            $response->getBody()->write(json_encode($users));
            return $response;
        }
        catch(PDOException $e)
        {
            echo '{"error"}: {"text": '.$e->getMessage().'}';
        }
    }
}