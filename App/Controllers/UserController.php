<?php

namespace App;

class UserController
{
    public static function users($request, $response)
    {
        print_r([
            'method' => $request->method,
            'uri' => $request->uri,
            'params' => $request->params,
            'headers' => $request->headers
        ]);
    }
}