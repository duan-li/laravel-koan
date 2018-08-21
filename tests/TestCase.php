<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;
use Tests\Utility\FakerEnvironment;
use Faker\Factory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    /** @var \Faker\Generator $faker */
    protected $faker;

    /** @var  FakerEnvironment $env */
    protected $env;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create('en_AU');
        $this->env = new FakerEnvironment();
    }
}
