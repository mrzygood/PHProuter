<?php

use PHProuter\Route;
use PHProuter\RouteCollection;
use PHProuter\Router;
use Symfony\Component\HttpFoundation\Request;

include "vendor/autoload.php";

$routeCollection = new RouteCollection();

$routeCollection->add(new Route('GET', '/other/{path}/{cos?}', 'HomeController@index', [
    'cos' => '\d',
    'path' => '(\w){1,}'
]));

$routeCollection->add(new Route('GET', 'my/path/to/check', 'HomeController@index'));

$routeCollection->add(new Route('GET', '/', 'HomeController@index'));

$router = new Router($routeCollection);

$request = Request::createFromGlobals();

$router->direct($request->getPathInfo(), $request->getMethod());

var_dump($routeCollection->getRoutes());