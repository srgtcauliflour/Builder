<?php

namespace Core;

use Core\Middleware;

class Router
{

    public static $response;
    public static $request;
    public static $middleware;

    public static function setup()
    {
        self::$request = new Request();
        self::$response = new Response();
    }

    public static function routes($router)
    {
        $router->get('/user', 'UserController.index');
        $router->get('/user/{id}', 'UserController.detail');
    }

    public static function middleware($middleware)
    {
        $middleware->add('UserController.detail', function ($request) {
            if ($request->params->id != '1')
            {
                die('now allowed');
            }
        });
    }

    public static function notFound()
    {
        echo 404;
    }

    public static function notAllowed($allowedMethods)
    {
        $methods = implode(', ', $allowedMethods);
        $methods = ltrim(', ');
        echo "only {$methods} are allowed";
    }

    public static function found($handler)
    {
        $full = $handler;
        $handler = explode('.', $handler);

        self::$middleware->exec($full, self::$request);
        call_user_func("App\\{$handler[0]}::{$handler[1]}", self::$request, self::$response);
    }

}
