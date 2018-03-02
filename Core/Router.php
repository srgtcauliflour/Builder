<?php

namespace Core;

class Router
{

    public static $response;
    public static $request;

    public static function setup()
    {
        self::$request = new Request();
        self::$response = new Response();
    }

    public static function routes($router)
    {
        $router->get('/users', 'UserController.users');
        $router->get('/user/{userId}/post/{postId}', 'UserController.users');
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
        $handler = explode('.', $handler);
        call_user_func("App\\{$handler[0]}::{$handler[1]}", self::$request, self::$response);
    }

}
