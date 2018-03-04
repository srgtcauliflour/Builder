<?php

use Core\Router;
use Core\Response;
use Core\Request;
use Core\Middleware;
use Core\Helpers\Helper;

require __DIR__ . '/../Core/Bootstrap.php';

Router::setup();
Router::$middleware = new Middleware();

/**
 * Set routes
 */
$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $router) {
    Router::routes($router);
}, [
    'cacheFile' => CACHE . '/route.cache',
    'cacheDisabled' => LOCAL
]);

/**
 * Get request info
 */
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(explode('?', $_SERVER['REQUEST_URI'])[0]);
$uri = rtrim($uri, '/');

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
        Router::middleware(Router::$middleware);
        Router::$request->params = Helper::arrayToObject($routeInfo[2]);
        Router::found($routeInfo[1]);
        break;
}

