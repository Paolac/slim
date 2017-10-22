<?php
require '../vendor/autoload.php';
require '../models/Users.php';
require '../src/handlers/exceptions.php';

$config = include('../src/config.php');

$app = new \Slim\App(['settings'=> $config]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule->getContainer()->singleton(
  Illuminate\Contracts\Debug\ExceptionHandler::class,
  App\Exceptions\Handler::class
);
$app->get('/', function($request, $response) {
  return $response->getBody()->write("Hello");
});

$app->get('/user/', function($request, $response) {
  return $response->getBody()->write("Hello");
});

$app->run();
