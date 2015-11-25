<?php
/**
 * リダイレクトによる実装
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/** ルート設定 */
$routes = include __DIR__.'/routes.php';

$req = Request::createFromGlobals();

$context = new Routing\RequestContext();
$context->fromRequest($req);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);


try {
    // 存在するルートならredirect
    $matched = $matcher->match($req->getPathInfo());
    $redirectPath = '/'.basename(__DIR__).'/pages/'.$matched['_route'].'.php';
    header('Pramga: no-cache');
    header('location: ' . $redirectPath);
    exit;
} catch(Routing\Exception\ResourceNotFoundException $e) {
    $body = "Not Found <br>\n";
    $body .= "pathInfo: " . $req->getPathInfo() . "<br>\n";
    $body .= "file: Unmatched <br>\n";
    $res = new Response($body, 404);
    $res->send();
} catch(\Exception $e) {
    $res = new Response('An error occurred', 500);
    $res->send();
}

