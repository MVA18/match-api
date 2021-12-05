<?php

namespace App\Http\Controllers;

use App\Actions\createUserAction;
use App\Data\CreateRandomUserData;
use App\Models\Matches;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Request;

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

    public function profiles(Request $request, Response $response, $id)
    {
        $ageMin = (isset($request->getQueryParams()['ageMin'])) ? $request->getQueryParams()['ageMin'] : 18;
        $ageMax = (isset($request->getQueryParams()['ageMax'])) ? $request->getQueryParams()['ageMax'] : 100;

        if(isset($ageMin) || isset($ageMax))
        {
            $users = DB::table('users')
            ->where('id', '!=', $id)
            ->where('age', '<', $ageMax)
            ->where('age', '>', $ageMin)
            ->whereNotIn('id', DB::table('matches')->select('profile_id')->where('user_id', '=', $id))->get();
        }
        else
        {
            $users = DB::table('users')->where('id', '!=', $id)
            ->whereNotIn('id', DB::table('matches')->select('profile_id')->where('user_id', '=', $id))->get();
        }
        
        $response->getBody()->write(json_encode($users));
        return $response;
    }

    public function swipe(Response $response, $user_id, $profile_id, $pref)
    {
        $checked = DB::table('matches')
                    ->where('user_id', '=', $user_id)
                    ->where('profile_id', '=', $profile_id)->first();

        if(isset($checked))
        {
            $response->getBody()->write(json_encode('already setted preference'));
            return $response; 
        }

        if($pref == true)
        {
            $match = DB::table('matches')
                    ->where('user_id', '=', $profile_id)
                    ->where('profile_id', '=', $user_id)
                    ->where('pref', '=', 1)->first();

            if(isset($match))
            {
                $response->getBody()->write(json_encode('Matched'));
                return $response;
            }
        }

        Matches::create([
            'user_id'       =>  $user_id,
            'profile_id'    =>  $profile_id,
            'pref'          =>  $pref
        ]);

        $response->getBody()->write(json_encode('setted preference for profile'));
        return $response; 

    }
}