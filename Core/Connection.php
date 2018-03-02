<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Secret;

class Connection
{

    /**
     * Capsule
     * @var Illuminate\Database\Capsule\Manager
     */
    private static $capsule;

    /**
     * Setup the connection
     * @return void
     */
    public static function setup()
    {
        if (!self::$capsule)
        {
            self::set();
        }
    }

    /**
     * Get capsule
     * @return Illuminate\Database\Capsule\Manager
     */
    public static function get()
    {
        return self::$capsule;
    }

    /**
     * Set capsule using data from .secret file
     * @return void
     */
    public static function set()
    {
        self::$capsule = new Capsule;
        self::$capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => (Secret::get('Host') ? Secret::get('Host') : 'localhost'),
            'database'  => Secret::get('Database'),
            'username'  => (Secret::get('Username') ? Secret::get('Username') : 'root'),
            'password'  => (Secret::get('Password') ? Secret::get('Password') : ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => (Secret::get('Prefix') ? Secret::get('Prefix') : ''),
        ]);
        self::$capsule->setAsGlobal();
        self::$capsule->bootEloquent();
    }

}
