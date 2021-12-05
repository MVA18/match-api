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
        $user = User::where('token', '=', $token);
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
                $usrObj->getByToken($tokenAuth);
                $this->app->auth_user = $usrObj;
                //Update token's expiration
                User::keepTokenAlive($tokenAuth);
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





// use App\Models\User;

// class TokenAuthMiddleware
// {
 
//     public function __construct() 
//     {  
//         $this->whiteList = array('/\api\/user\/create', '\/api\/auth');
//     }
 
//     /**
//      * Deny Access
//      *
//      */
//     public function deny_access() {
//         $res = $this->app->response();
//         $res->status(401);
//     }
 
//     /**
//      * Check against the DB if the token is valid
//      * 
//      * @param string $token
//      * @return bool
//      */
//     public function authenticate($token) {
//         //$tokens = User::all()->pluck('token');
//         //return $user->validateToken($token);
//     }
 
//     /**
//      * This function will compare the provided url against the whitelist and
//      * return wether the $url is public or not
//      * 
//      * @param string $url
//      * @return bool
//      */
//     public function isPublicUrl($url) {
//         $patterns_flattened = implode('|', $this->whiteList);
//         $matches = null;
//         preg_match('/' . $patterns_flattened . '/', $url, $matches);
//         return (count($matches) > 0);
//     }
 
//     /**
//      * Call
//      * 
//      * @todo beautify this method ASAP!
//      *
//      */
//     public function __invoke()
//     {
//         //Get the token sent from jquery
//         $tokenAuth = $this->app->request->headers->get('Authorization');
//         //We can check if the url requested is public or protected
//         if ($this->isPublicUrl($this->app->request->getPathInfo())) {
//             //if public, then we just call the next middleware and continue execution normally
//             $this->next->call();
//         } else {
//             //If protected url, we check if our token is valid
//             if ($this->authenticate($tokenAuth)) {
//                 //Get the user and make it available for the controller
//                 $usrObj = new User();
//                 $usrObj->getByToken($tokenAuth);
//                 $this->app->auth_user = $usrObj;
//                 //Update token's expiration
//                 User::keepTokenAlive($tokenAuth);
//                 //Continue with execution
//                 $this->next->call();
//             } else {
//                 $this->deny_access();
//             }
//         }
//     }
 
// }