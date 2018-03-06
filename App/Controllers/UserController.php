<?php

namespace App\Controller;

use View;

class UserController
{
    public static function index($request, $response)
    {
        $response->view('Home.php', 'Main.php');
    }

    public static function detail($request, $response)
    {
        $type = new \App\Model\Type();
    }

    public static function store($request, $response)
    {
        # code...
    }

    public static function update($request, $response)
    {
        # code...
    }
}