<?php

use DI\Bridge\Slim\Bridge as SlimAppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Handlers/Exceptions.php';

$container = new Container;

$settings = require __DIR__ . '/../src/settings.php';

$settings($container);

$app = SlimAppFactory::create($container);

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'match_database',
    'port' => '3306',
    'database' => 'match_database',
    'username' => 'match_user',
    'password' => 'match_password',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
  ]);
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