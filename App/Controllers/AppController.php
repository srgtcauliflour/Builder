<?php

namespace App\Controller;

class AppController
{

    public static function dashboard($request, $response)
    {
        $response->view('dashboard.php');
    }

    public static function app($request, $response)
    {
        $response->view('app.php');
    }

}
