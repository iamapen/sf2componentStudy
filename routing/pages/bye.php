<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$req = Request::createFromGlobals();

$res = new Response();
$res->setContent('Bye-bye!!');
$res->send();