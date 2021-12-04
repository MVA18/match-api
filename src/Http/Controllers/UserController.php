<?php

namespace App\Http\Controllers;

use App\config\DB;
use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;

class UserController
{
    public function create(Response $response)
    {
        $faker = \Faker\Factory::create();

        $genders = ['male','female'];

        $gender = $genders[array_rand($genders, 1)];
        $name = $faker->name($gender);
        $email = $faker->email;
        $password = '12345678';
        
        $age = rand(18,100);

        $sql = "INSERT INTO users (email, password, name, gender, age) VALUES('$email', '$password', '$name', '$gender', $age)";

        try
        {
            $db = new DB();
            $db = $db->connect();

            $stmt = $db->query($sql);

            $db->query($sql);

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

    public function profiles(Response $response, $id)
    {

        $sql = "SELECT * FROM users WHERE id <> $id";

        try
        {
            $users = queryDB($sql);
            $response->getBody()->write(json_encode($users));
            return $response;
        }
        catch(PDOException $e)
        {
            echo '{"error"}: {"text": '.$e->getMessage().'}';
        }
    }

    public function swipe(Response $response, $user_id, $profile_id, $pref)
    {
        $check_match = "SELECT * FROM matches WHERE (user_id = $profile_id AND profile_id = $user_id) AND pref = 1";

        $check_if_already_voted_false = "SELECT * FROM matches WHERE user_id = $user_id AND profile_id = $profile_id";

        $setMatch = "INSERT INTO matches (user_id, profile_id, pref) VALUES($user_id, $profile_id, $pref)";

        try
        {
            $checked = queryDB($check_if_already_voted_false);
            if(isset($checked))
            {
                $response->getBody()->write(json_encode('already setted preference'));
                return $response; 
            }

            if($pref == true)
            {
                $match = queryDB($check_match);
                if(isset($match))
                {
                    $response->getBody()->write(json_encode('Matched'));
                    return $response;
                }
            }

            queryDB($setMatch);
            $response->getBody()->write(json_encode('setted preference for profile'));
            return $response; 

        }
        catch(PDOException $e)
        {
            echo '{"error"}: {"text": '.$e->getMessage().'}';
        }
    }
}