<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$response = new Response();

$map = [
    '/' => __DIR__.'/../index.php',
    '/login'   => __DIR__.'/../login.php',
    '/check-login' => __DIR__ . '/../check-login.php'
];

$path = $request->getPathInfo();
if (isset($map[$path])) {
    require $map[$path];
} else {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();