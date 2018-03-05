<?php

namespace Tests\UnitTests\Core;

use PHPUnit\Framework\TestCase;
use Core\Cache;

class CacheTest extends TestCase
{

    public function setup()
    {
        Cache::clear();
    }

    /**
     * @test
     */
    public function set()
    {
        $this->assertTrue(Cache::set("Test", "1", [
            "data" => true
        ]));
    }

    /**
     * @test
     */
    public function get()
    {
        Cache::set("Test", "1", [
            "data" => true
        ]);

        $this->assertTrue(is_array(Cache::get("Test", "1")));
        $this->assertSame(Cache::get("Test", "1")['data'], true);
    }

    /**
     * @test
     */
    public function exists()
    {
        Cache::set("Test", "1", [
            "data" => true
        ]);

        $this->assertTrue(Cache::exists("Test", "1"));
    }

    /**
     * @test
     */
    public function clear()
    {
        $this->assertTrue(Cache::clear());
    }

}
