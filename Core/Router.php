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
    public static function routes($collection)
    {
        $collection->get('/user', 'UserController.index');
        $collection->get('/user/{id}', 'UserController.detail');
        $collection->post('/user', 'UserController.store');
        $collection->put('/user/{id}', 'UserController.update');
    }

    /**
     * Create middleware
     * @param Core\Middleware
     * @return void
     */
    public static function middleware($collection)
    {
        $collection->add('UserController.detail', 'User.denyDetails');
    }

    /**
     * On 404 request
     * @return void
     */
    public static function notFound()
    {
        \http_response_code(404);
    }

    /**
     * On method not allowed
     * @param array allowed methods
     * @return void
     */
    public static function methodNotAlowed($allowedMethods)
    {
        \http_response_code(405);
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

        self::$middleware->exec('*', self::$request, self::$response);
        self::$middleware->exec($full, self::$request, self::$response);
        call_user_func("App\\Controller\\{$handler[0]}::{$handler[1]}", self::$request, self::$response);
    }

}
