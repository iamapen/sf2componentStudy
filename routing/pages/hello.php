<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$req = Request::createFromGlobals();
$name = $req->get('name', 'World');

$body = sprintf('Hello %s!!', $name);

$res = new Response();
$res->setContent(htmlspecialchars($body, ENT_QUOTES, 'UTF-8'));
$res->send();