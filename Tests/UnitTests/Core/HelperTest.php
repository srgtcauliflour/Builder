<?php

namespace Tests\UnitTests\Core;

use PHPUnit\Framework\TestCase;
use Core\Helper;

class HelperTests extends TestCase
{

    /**
     * @test
     */
    public function arrayToObjectTest()
    {
        $this->assertTrue(is_object(Helper::arrayToObject(["1","2","3"])));
    }

    /**
     * @test
     */
    public function objectToArrayTest()
    {
        $this->assertTrue(
            is_array(
                Helper::objectToArray(
                    json_decode(
                        json_encode([1,2,3]))
                    )
                )
            );
    }

    /**
     * @test
     */
    public function generateSlugTest()
    {
        $this->assertSame(Helper::generateSlug("slugify me", "_"), "slugify_me");
    }

    /**
     * @test
     */
    public function deleteContentTest()
    {
        if (!file_exists(TEST_DATA))
        {
            mkdir(TEST_DATA);
        }

        \file_put_contents(TEST_DATA . "/test", "test");

        Helper::deleteContent(TEST_DATA);
        $this->assertTrue(!file_exists(TEST_DATA . '/testDir'));
    }

}
