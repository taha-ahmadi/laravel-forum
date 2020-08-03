<?php

namespace Tests\Feature;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_all_available_threads()
    {
        $response = $this->get(route("threads.index"));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function show_thread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get(route("threads.show", [
            'thread' => $thread->slug
        ]));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function create_thread_should_be_validate()
    {
        $response = $this->postJson(route("threads.store"), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function create_new_thread()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $response = $this->postJson(route("threads.store"), [
            'title' => "title",
            'content' => "content",
            'channel_id' => factory(Channel::class)->create()->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /** @test */
    public function update_thread_should_be_validate()
    {
        Sanctum::actingAs(factory(User::class)->create());

        $thread = factory(Thread::class)->create();

        $response = $this->putJson(route("threads.update", [$thread]), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function update_thread()
    {
        $this->withoutExceptionHandling();

        $thread = factory(Thread::class)->create([
            'title' => "test1",
            'content' => "content",
            'channel_id' => factory(Channel::class)->create()->id,
        ]);

        Sanctum::actingAs(factory(User::class)->create());

        $this->putJson(route("threads.update", [$thread->id]), [
            'title' => "title",
            'content' => "content",
            'channel_id' => factory(Channel::class)->create()->id,
        ])->assertSuccessful();

        $thread->refresh();

        $this->assertSame('title', $thread->title);
    }
}
