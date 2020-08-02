<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Register Route
     *
     * @return void
     */
    public function test_register_should_be_validated()
    {
        $response = $this->postJson(route("auth.register"));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test User Register
     *
     * @return  void
     */
    public function test_user_register()
    {
        $response = $this->postJson(route("auth.register"), [
            "name" => "test",
            "email" => "aaaa@gmail.com",
            "password" => "password",
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test Register Route
     *
     * @return void
     */
    public function test_login_should_be_validated()
    {
        $response = $this->postJson(route("auth.register"));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test Login
     *
     * @return void
     */
    public function test_user_login()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson(route("auth.login"), [
            "email" => $user->email,
            "password" => "password",
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test Is User Logged In
     *
     * @return void
     */
    public function test_is_user_logged_in_login()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route("auth.user"));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test Logout
     *
     * @return void
     */
    public function test_user_logout_login()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson(route("auth.logout"));

        $response->assertStatus(Response::HTTP_OK);
    }
}
