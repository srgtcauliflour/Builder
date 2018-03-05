<?php

namespace Tests\UnitTests\Core;

use PHPUnit\Framework\TestCase;
use Core\Secret;

class SecretTest extends TestCase
{

    /**
     * @test
     */
    public function addTest()
    {
        try
        {
            Secret::add("Test", "Test");
            Secret::remove("Test");
            $this->assertTrue(true);
        }
        catch(\Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @test
     */
    public function getTest()
    {
        try
        {
            Secret::add("Test", "Test");
            Secret::get("Test");
            Secret::remove("Test");
            $this->assertTrue(true);
        }
        catch (\Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @test
     */
    public function removeTest()
    {
        try
        {
            Secret::add("Test", "Test");
            Secret::remove("Test");
            $this->assertTrue(true);
        }
        catch (\Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}
