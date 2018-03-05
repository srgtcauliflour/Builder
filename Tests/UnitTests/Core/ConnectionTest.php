<?php

namespace Tests\UnitTests\Core;

use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{

    /**
     * @test
     */
    public function connectedTest()
    {
        $this->assertTrue(is_object(\Core\Connection::get()));
    }

    /**
     * @test
     */
    public function testQuery()
    {
        $this->assertTrue(\Core\Connection::ping());
    }

}
