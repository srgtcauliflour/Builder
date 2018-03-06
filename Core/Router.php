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
        include APP . DIRECTORY_SEPARATOR . "Router.php";
        \routes($router);
    }

    /**
     * Create middleware
     * @param Core\Middleware
     * @return void
     */
    public static function middleware($middleware)
    {
        include APP . DIRECTORY_SEPARATOR . "Middleware.php";
        \middleware($middleware);
    }

    /**
     * On 404 request
     * @return void
     */
    public static function notFound()
    {
        \http_response_code(404);
        include APP . DIRECTORY_SEPARATOR . "404.php";
    }

    /**
     * On method not allowed
     * @param array allowed methods
     * @return void
     */
    public static function methodNotAlowed($allowedMethods)
    {
        \http_response_code(405);
        include APP . DIRECTORY_SEPARATOR . "405.php";
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
