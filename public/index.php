<?php

use DI\Bridge\Slim\Bridge as SlimAppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Handlers/Exceptions.php';

$container = new Container;

$settings = require __DIR__ . '/../src/Config/settings.php';
$settings($container);

$settings = require __DIR__ . '/../src/Config/db_settings.php';
$app = SlimAppFactory::create($container);
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($db_settings);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$capsule->getContainer()->singleton(
  Illuminate\Contracts\Debug\ExceptionHandler::class,
  AppExceptionsHandler::class
);

$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../src/routes.php';
$routes($app);

$app->run();