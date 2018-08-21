<?php
declare(strict_types=1);

namespace Tests\Unit\Koan\AboutAuthentication;

use Illuminate\Auth\SessionGuard;
use Illuminate\Auth\TokenGuard;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthFacadesTest extends TestCase
{

    public function test_attempt_login(): void
    {
        $user = $this->env->user;

        $credentials = [
            'email' => $user->email,
            'password' => $this->faker->word
        ];

        static::assertFalse(Auth::attempt($credentials));

        $credentials = [
            'email' => $user->email,
            'password' => 'secret'
        ];

        static::assertTrue(Auth::attempt($credentials));
    }

    public function test_auth(): void
    {
        $user = $this->env->user;

        static::assertFalse(Auth::check());

        Auth::login($user);

        $loginedUser = Auth::user();

        static::assertEquals($loginedUser->id, $user->id);
        static::assertEquals(Auth::id(), $user->id);
        static::assertTrue(Auth::check());
    }

    public function test_guard(): void
    {
        // check config/auth.php
        $webGuard = Auth::guard('web');
        $apiGuard = Auth::guard('api');

        static::assertInstanceOf(SessionGuard::class, $webGuard);
        static::assertInstanceOf(TokenGuard::class, $apiGuard);

        static::assertFalse(Auth::check());
    }

    public function test_guard_attempt_login(): void
    {
        $user = $this->env->user;

        $credentials = [
            'email' => $user->email,
            'password' => 'secret'
        ];

        Auth::guard('web')->attempt($credentials);

        static::assertTrue(Auth::check());
        static::assertFalse(Auth::guard('api')->check());
    }


    public function test_logout(): void
    {
        $user = $this->env->user;

        static::assertFalse(Auth::check());

        Auth::login($user);

        static::assertTrue(Auth::check());

        Auth::logout();

        static::assertFalse(Auth::check());
    }

    public function test_remember(): void
    {
        \Session::start();
        $user = $this->env->user;

        $credentials = [
            'email' => $user->email,
            'password' => 'secret'
        ];
        Auth::attempt($credentials, true);
        $loginedUser = Auth::user();
        static::assertEquals($loginedUser->id, $user->id);
        static::assertTrue(Auth::check());
        static::assertTrue(Auth::viaRemember());

        session()->put('a', 1);

        static::assertTrue(session()->has('a'));

        \Session::flush();
    }

    public function test_login_by_user_id(): void
    {
        $user = $this->env->user;
        static::assertFalse(Auth::check());
        Auth::loginUsingId($user->id);

        $loginedUser = Auth::user();
        static::assertEquals($loginedUser->id, $user->id);
        static::assertTrue(Auth::check());
    }

    public function test_auth_user_once(): void
    {
        $user = $this->env->user;

        $credentials = [
            'email' => $user->email,
            'password' => 'secret'
        ];
        static::assertFalse(Auth::check());
        Auth::once($credentials);

        $loginedUser = Auth::user();
        static::assertEquals($loginedUser->id, $user->id);
        static::assertTrue(Auth::check());
    }



}
