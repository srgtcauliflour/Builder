<?php

namespace App;

use Core\View;

class UserController
{
    public static function index($request, $response)
    {
        View::serve("Home.php");
    }

    public static function detail($request, $response)
    {
        echo $request->params->id;
    }
}