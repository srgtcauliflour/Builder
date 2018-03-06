<?php

namespace App;

use View;

class UserController
{
    public static function index($request, $response)
    {
        $response->view('Home.php', 'Main.php');
    }

    public static function detail($request, $response)
    {
        echo $request->params->id;
    }
}