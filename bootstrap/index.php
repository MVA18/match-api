<?php

use DI\Bridge\Slim\Bridge as SlimAppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container;

$settings = require __DIR__ . '/../src/settings.php';
$settings($container);

$app = SlimAppFactory::create($container);

$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../src/routes.php';
$routes($app);
//User Routes
//require '../src/routes/users.php';

$app->run();