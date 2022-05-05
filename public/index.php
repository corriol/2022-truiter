<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//var_dump($_REQUEST, $_GET, $_POST, $_SERVER, $_COOKIE, $_SESSION);
$request = Request::createFromGlobals();

//echo "<hr />";
//var_dump($request);

$response = new Response();

$map = [
    '/' => __DIR__.'/../index.php',
    '/login'   => __DIR__.'/../login.php',
    '/check-login' => __DIR__ . '/../check-login.php',
    '/check-register' => __DIR__ . '/../check-register.php',
    '/register' => __DIR__ . '/../register.php',
];


$path = $request->getPathInfo();
if (isset($map[$path])) {
    require $map[$path];
} else {
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    $response->setContent('Not Found');
}

$response->send();