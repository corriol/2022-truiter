<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

//var_dump($_REQUEST, $_GET, $_POST, $_SERVER, $_COOKIE, $_SESSION);
$request = Request::createFromGlobals();
$routes = require __DIR__ . '/../src/app.php';


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
$context = new RequestContext();
$context->fromRequest($request);

$generator = new UrlGenerator($routes,$context);
$matcher = new UrlMatcher($routes, $context);


try {
    $attributes = $matcher->match($request->getPathInfo());
    ob_start();
    extract($attributes, EXTR_SKIP);
    include sprintf(__DIR__ . '/../src/pages/%s.php', $_route);
    $response = new Response(ob_get_clean());
}
catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
}
catch (Exception $exception) {
    $response = new Response('Hi ha hagut un error', Response::HTTP_INTERNAL_SERVER_ERROR);
}
$response->send();