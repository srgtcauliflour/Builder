<?php

/**
 * Define paths
 */
define('ROOT', __DIR__ . '/..');
define('CORE', ROOT . '/Core');
define('APP', ROOT . '/App');
define('CONFIG', ROOT . '/Config');
define('Migrations', ROOT . '/Migrations');
define('PUBLIC', ROOT . '/public');

/**
 * Require main files
 */
require ROOT . '/vendor/autoload.php';
require CORE . '/Helpers/Helper.php';
require CORE . '/Helpers/Autoloader.php';

use Core\Helpers\Autoloader;
use Core\Secret;
use Core\Connection;
use Core\Router;

/**
 * Setup autoloader
 */
$autoloader = new Autoloader();
$autoloader->addFile(CORE . '/Secret.php');
$autoloader->addFile(CORE . '/Connection.php');
$autoloader->addFile(CORE . '/Router.php');

$autoloader->addFolder(APP . '/Services');
$autoloader->addFolder(APP . '/Middlewares');
$autoloader->addFolder(APP . '/Models');
$autoloader->addFolder(APP . '/Controllers');

$autoloader->autoload();

/**
 * Setup core
 */
Secret::setup();
Connection::setup();
Router::setup();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    Router::routes($r);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        Router::notFound();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        Router::methodNotAlowed($allowedMethods);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        Router::found($handler, $vars);
        break;
}

