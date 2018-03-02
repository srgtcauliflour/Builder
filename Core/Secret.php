<?php

namespace Core;

use \Core\Helpers\Helper;

class Secret
{

    /**
     * Container for properties
     * @var object
     */
    private static $properties;

    /**
     * Setup class
     * @return void
     */
    public static function setup()
    {
        self::set();
    }

    /**
     * Get a property
     * @param string property name
     * @return string property
     * @throws Exception name does not exist
     */
    public static function get($name)
    {
        $prop = @self::$properties->{$name};
        
        if (!$prop)
        {
            return false;
            // throw new \Exception("Property {$name} does not exist");
        }

        return $prop;
    }

    /**
     * Get all serets and set properties
     * @return void
     * @throws Exception missing secret
     */
    public static function set()
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
                    $properties[$keyVal[0]] = $keyVal[1] ? $keyVal[1] : '';
                }
            }

            self::$properties = Helper::arrayToObject($properties);
        }
        else
        {
            throw new Exception('Missing .secret file');
        }
    }

    /**
     * Add secret to file
     * @param string key
     * @param string val
     * @return void
     * @throws Exception
     */
    public static function add($key, $val)
    {
        $file = ROOT . '/.secret';
        $s = PHP_EOL;

        if (!file_exists($file))
        {
            throw new \Exception('Missing .secret file');
        }

        \file_put_contents($file, "{$key}={$val}{$s}", FILE_APPEND | LOCK_EX);
    }

    /**
     * Remove secret from file
     * @param string key
     * @return void
     * @throws Exception
     */
    public static function remove($key)
    {
        $file = ROOT . '/.secret';

        if (!file_exists($file))
        {
            throw new \Exception('Missing .secret file');
        }

        $content = \file_get_contents($file);
        $content = preg_replace("/({$key})\=\w{0,}\s*/", "", $content);
        file_put_contents($file, $content);
    }

}

