<?php

namespace App\Controller;

class AuthController
{

    public static function loginPage($request, $response)
    {
        $response->view('login.php');
    }

}
