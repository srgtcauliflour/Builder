<?php

/**
 * Define paths
 */
define('ROOT', __DIR__ . '/..');
define('CORE', ROOT . '/Core');
define('HELPERS', CORE . '/Helpers');
define('APP', ROOT . '/App');
define('CONFIG', ROOT . '/Config');
define('Migrations', ROOT . '/Migrations');
define('PUBLIC', ROOT . '/public');

if (!isset($useRouter))
{
    $useRouter = true;
}

/**
 * Require main files
 */
require ROOT . '/vendor/autoload.php';
require HELPERS . '/Helper.php';
require HELPERS . '/Autoloader.php';

use Core\Helpers\Helper;
use Core\Helpers\Autoloader;
use Core\Secret;
use Core\Connection;
use Core\Router;
use Core\Response;
use Core\Request;

/**
 * Setup autoloader
 */
$autoloader = new Autoloader();
$autoloader->addFile(CORE . '/Secret.php');
$autoloader->addFile(CORE . '/Connection.php');
$autoloader->addFile(CORE . '/Response.php');
$autoloader->addFile(CORE . '/Request.php');
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

if ($useRouter)
{
    Router::setup();

    /**
     * Set routes
     */
    $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {
        Router::routes($router);
    });

    /**
     * Get request info
     */
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = rawurldecode(explode('?', $_SERVER['REQUEST_URI'])[0]);

    /**
     * Set request object
     */
    Router::$request->method = $httpMethod;
    Router::$request->uri = $uri;
    Router::$request->headers = getallheaders();

    /**
     * Dispatch
     */
    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        /**
         * Route not found
         */
        case FastRoute\Dispatcher::NOT_FOUND:
            Router::notFound();
            break;
        /**
         * Method not allowed
         */
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            Router::methodNotAlowed($routeInfo[1]);
            break;
        /**
         * Route found
         */
        case FastRoute\Dispatcher::FOUND:
            Router::$request->params = Helper::arrayToObject($routeInfo[2]);
            Router::found($routeInfo[1]);
            break;
    }
}
