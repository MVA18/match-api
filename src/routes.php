<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Slim\App;

return function(App $app){

    $app->post('/api/auth', [AuthController::class, 'auth']);
    $app->get('/api/user/create',   [UserController::class, 'create']);

    $app->get('/api/profiles/{id}', [UserController::class, 'profiles']);
    $app->get('/api/swipe/{user_id}/{profile_id}/{pref}', [UserController::class, 'swipe']);
};

