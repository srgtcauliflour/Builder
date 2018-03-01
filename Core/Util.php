<?php

namespace App;

class Util
{

    static $properties;

    public function __construct()
    {
        # code...
    }

    public function getSecretProperty($name)
    {
        self::$properties[$name];
    }

    public function getSecrets($type = 'array')
    {
        $file = ROOT . '/.secret';

        if (\file_exists($file))
        {
            $content = \file_get_contents($file);
            $content = explode(PHP_EOL, $content);
            
            $properties = [];
            foreach ($content as $property)
            {
                $property = trim($property);
                if ($property != '')
                {
                    $keyVal = explode('=', $property);
                    $properties[$keyVal[0]] = $properties[$keyVal[1]];
                }
            }

            self::$properties = $properties;

            return $return;
        }
        else
        {
            throw new Exception('Missing .secret file');
        }

    }

}

