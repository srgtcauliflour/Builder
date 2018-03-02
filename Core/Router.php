<?php

namespace Core;

use Core\Middleware;

class Router
{

    public static $response;
    public static $request;
    public static $middleware;

    /**
     * Setup class
     * @return void
     */
    public static function setup()
    {
        self::$request = new Request();
        self::$response = new Response();
    }

    /**
     * Create routes
     * @param FastRoute\RouteCollector collection
     * @return void
     */
    public static function routes($router)
    {
        $router->get('/user', 'UserController.index');
        $router->get('/user/{id}', 'UserController.detail');
    }

    /**
     * Create middleware
     * @param Core\Middleware
     * @return void
     */
    public static function middleware($middleware)
    {
        $middleware->add('UserController.detail', 'User.denyDetails');
    }

    /**
     * On 404 request
     * @return void
     */
    public static function notFound()
    {
        echo 404;
    }

    /**
     * On method not allowed
     * @param array allowed methods
     * @return void
     */
    public static function notAllowed($allowedMethods)
    {
        $methods = implode(', ', $allowedMethods);
        $methods = ltrim(', ');
        echo "only {$methods} are allowed";
    }

    /**
     * On route found
     * @param string handle
     * @return void
     */
    public static function found($handler)
    {
        $full = $handler;
        $handler = explode('.', $handler);

        self::$middleware->exec($full, self::$request, self::$response);
        call_user_func("App\\{$handler[0]}::{$handler[1]}", self::$request, self::$response);
    }

}
