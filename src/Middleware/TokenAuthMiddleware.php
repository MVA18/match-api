<?php

use App\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class TokenAuthMiddleware
{

    public function __construct() 
    {  
        $this->whiteList = array('/api/user/create', '/api/auth');
    }

    public function authenticate($token) 
    {
        $user = User::where('token', '=', $token)->first();
        return (isset($user)) ? true : false;
    }

    public function isPublicUrl($url) 
    {
        return in_array($url, $this->whiteList);
    }

    public function __invoke(Request $request, RequestHandler $handler)
    {
        if ($this->isPublicUrl($request->getUri()->getPath())) 
        {
            $response = $handler->handle($request);
            return $response;
        } 
        else 
        {
            $tokenAuth = (isset($request->getHeaders()['Authorization'])) ? $request->getHeaders()['Authorization'] : null;
            //If protected url, we check if our token is valid
            
            if (isset($tokenAuth) && $this->authenticate($tokenAuth)) 
            {
                $usrObj = new User();
                $user = $usrObj->getByToken($tokenAuth);
                $user->keepTokenAlive();
                //Continue with execution
                $response = $handler->handle($request);
                return $response;
            } 
            else 
            {
                $response = new Response();
                $newResponse = $response->withStatus(401);
                return  $newResponse;
            }
        }
    }
}