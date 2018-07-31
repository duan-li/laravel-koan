<?php
declare(strict_types=1);

namespace Tests\Unit\Koan\AboutTheBasics;

use \Tests\TestCase;

class RouteTest extends TestCase
{

    public function test_case()
    {
        static::assertNotEmpty($this->faker->md5);
    }
}
