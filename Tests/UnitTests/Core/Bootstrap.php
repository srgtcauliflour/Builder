<?php

namespace Tests\UnitTests\Core;

use PHPUnit\Framework\TestCase;

class Bootstrap extends TestCase
{

    /**
     * @test
     */
    public function constantExists()
    {
        $consts = [
            'LOCAL', 'STAGING', 'PRODUCTION',
            'ROOT', 'CORE', 'CACHE',
            'MIGRATIONS'. 'TESTS', 'VENDOR',
            'NODE_MODULES', 'APP',
            'CONTROLLERS', 'MODELS', 'MIDDLEWARES',
            'SERVICES', 'FRONT_END',
        ];

        foreach ($consts as $const)
        {
            $this->assertTrue(isset($const));
        }

        return;
    }

    /**
     * @test
     */
    public function classExists()
    {
        $classes = [
            'Helper', 'Autoloader',
            'Secret', 'Cache', 'Connection',
            'Response', 'Request', 'Router',
            'Middleware', 'Console'
        ];

        foreach ($classes as $class)
        {
            $this->assertTrue(class_exists('Core\\' . $class));
        }

        return;
    }

}
