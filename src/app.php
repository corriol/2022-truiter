<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('index', new Route('/', [
    '_controller' => 'App\Controllers\DefaultController::index'
    ]));
$routes->add('login', new Route('/login'));
$routes->add('checkLogin', new Route('/check-login'));
$routes->add('register', new Route('/register'));
$routes->add('checkRegister', new Route('/checkRegister'));
$routes->add('test', new Route('/test', ['_controller' => function ($request) {
    return new \Symfony\Component\HttpFoundation\Response("Test route");
}]));

return $routes;