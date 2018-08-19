<?php
declare(strict_types=1);

namespace Tests\Unit\Koan\AboutTheBasics;

use \Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class RouteTest extends TestCase
{

    public function test_route_list()
    {
        $this->artisan('route:list');
        $output = Artisan::output();
        static::assertNotEmpty($output);

        static::assertContains('users.index', $output);
        static::assertContains('App\Http\Controllers\UserController@index', $output);
    }


    public function test_route_redirect()
    {
        $response = $this->get('users/home');

        $response->assertStatus(301);
        $response->assertRedirect(route('users.index'));
    }
}
