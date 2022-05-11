<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel;

function render_template($request) {
    ob_start();
    extract($request->attributes->all(), EXTR_SKIP);
    include sprintf(__DIR__ . '/../src/pages/%s.php', $_route);
    $response = new Response(ob_get_clean());
    return $response;
}

$request = Request::createFromGlobals();
$routes = require __DIR__ . '/../src/app.php';

$context = new RequestContext();
$context->fromRequest($request);

$generator = new UrlGenerator($routes,$context);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $attributes = $matcher->match($request->getPathInfo());
    $request->attributes->add($attributes);

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    var_dump($controller);
    var_dump($arguments);
    $response = call_user_func_array($controller, $arguments);
}
catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
}
catch (Exception $exception) {
    $response = new Response('Hi ha hagut un error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
}
$response->send();