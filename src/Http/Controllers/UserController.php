<?php

namespace App\Http\Controllers;

use App\Actions\createUserAction;
use App\Data\CreateRandomUserData;
use Illuminate\Database\Capsule\Manager as DB;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;

class UserController
{
    protected $createUserAction;

    public function __construct(createUserAction $createUserAction)
    {
        $this->createUserAction = $createUserAction;
    }
        
    public function create(Response $response)
    {
        $UserData = new CreateRandomUserData();
        $user = $this->createUserAction->create($UserData->data());
        
        $response->getBody()->write(json_encode($user));
        return $response;
    }

    public function profiles(Response $response, $id)
    {
        $users = DB::table('users')->where('id', '!=', $id)
        ->whereNotIn('id', DB::table('matches')->select('profile_id')->where('user_id', '=', $id))->get();
        
        $response->getBody()->write(json_encode($users));
        return $response;
    }

    public function swipe(Response $response, $user_id, $profile_id, $pref)
    {
        $check_match = "SELECT * FROM matches WHERE (user_id = $profile_id AND profile_id = $user_id) AND pref = 1";

        $check_if_already_voted_false = "SELECT * FROM matches WHERE user_id = $user_id AND profile_id = $profile_id";

        $setMatch = "INSERT INTO matches (user_id, profile_id, pref) VALUES($user_id, $profile_id, $pref)";

        try
        {
            $checked = queryDB($check_if_already_voted_false);
            if(isset($is_false))
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