<?php

namespace App\Http\Controllers;

use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    public function auth(Request $request, Response $response)
    {
        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];

        $user = User::all()->where('email', '=', $email)->first();
        
        if(isset($user) && $user->password == $password)
        {        
            $token = bin2hex(openssl_random_pseudo_bytes(8)); //generate a random token

            $tokenExpiration = date('Y-m-d H:i:s', strtotime('+1 hour'));//the expiration date will be in one hour from the current moment
            
            $user->update([
                'token' => $token, 
                'token_expire' => $tokenExpiration
            ]); 

            $user->save();

            $response->getBody()->write(json_encode($user->token));
            return $response;
        }
    
        $newResponse = $response->withStatus(401);
        return  $newResponse;
    }
}