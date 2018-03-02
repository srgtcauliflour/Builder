<?php

namespace Core;

class Router
{

    public static function setup()
    {

    }

    public static function routes($r)
    {
        $r->get('/users', 'UserController.users');
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

    public static function found($handler, $vars)
    {
        $handler = explode('.', $handler);
        call_user_func("App\\{$handler[0]}::{$handler[1]}", $vars);
    }

}
