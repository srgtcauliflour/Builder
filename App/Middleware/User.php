<?php

namespace Middleware;

class User
{
    
    public static function denyDetails($request, $response)
    {
        if ($request->params->id != '1')
        {
            $response->code(403);
            $response->json([
                'Code' => 403,
                'Error' => 'Now allowed'
            ]);

            $response->send();
        }
    }

}
