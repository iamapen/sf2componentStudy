<?php
/**
 * ルート定義
 */
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', ['name'=>'World']));
$routes->add('bye', new Routing\Route('/bye'));

$routes->add('a/1', new Routing\Route('/a1'));
$routes->add('b/1', new Routing\Route('/b1'));

return $routes;
