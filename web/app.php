<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$environment = 'prod';
$enableDebug = false;
if (isset($_SERVER['APP_ENV'])) {
    if ($_SERVER['APP_ENV'] == 'dev') {
        $environment = 'dev';
        $enableDebug = true;
    }
}

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
$enableDebug && Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel($environment, $enableDebug);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
