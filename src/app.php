<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('index', new Route('/'));
$routes->add('login', new Route('/login'));
$routes->add('checkLogin', new Route('/check-login'));
$routes->add('register', new Route('/register'));
$routes->add('checkRegister', new Route('/checkRegister'));

return $routes;