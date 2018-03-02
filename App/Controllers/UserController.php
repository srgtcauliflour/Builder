<?php

namespace App;

class UserController
{
    public static function index($request, $response)
    {
        print_r([
            'method' => $request->method,
            'uri' => $request->uri,
            'params' => $request->params,
            'headers' => $request->headers
        ]);
    }

    public static function detail($request, $response)
    {
        echo $request->params->id;
    }
}