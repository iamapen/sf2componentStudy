<?php
/**
 * フロントコントローラ
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
    // 存在するルートでファイルも存在すれば読み込み
    $matched = $matcher->match($req->getPathInfo());
    $file = sprintf(__DIR__.'/pages/%s.php', $matched['_route']);
    if(!file_exists($file)) {
        $body = "Not Found <br>\n";
        $body .= "pathInfo: " . $req->getPathInfo() . "<br>\n";
        $body .= "file: $file <br>\n";
        $res = new Response($body, 404);
        $res->send();
        exit(1);
    }
//    ob_start();
    include $file;
//    $body = ob_get_clean();
//    $res = new Response($body);
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

