<?php

namespace App;

class UserController
{
    public static function users($vars)
    {
        echo '<pre>';
        var_dump([
            $vars
        ]);
        echo '</pre>';
        die;
    }
}