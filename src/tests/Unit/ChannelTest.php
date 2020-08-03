<?php

namespace Tests\Unit;

use App\Channel;
use App\Repositories\ChannelRepository;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    /**
     * Test Get All Channels lists 
     *
     * @return void
     */
    public function test_get_all_channel_lists()
    {
        $response = $this->get(route("channel.all"));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test Channel no value send
     */

    public function test_channel_should_be_validated()
    {
        $response = $this->postJson(route("channel.create", []));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test Channel Creating.
     *
     * @return void
     */
    public function test_create_new_channel()
    {
        $response = $this->postJson(route("channel.create"), [
            "name" => "Taha"
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test Channel Creating.
     *
     * @return void
     */
    public function test_channel_update_should_be_validated()
    {
        $response = $this->json('PUT', route("channel.update"), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_update()
    {
        $channel = factory(Channel::class)->create();

        $response = $this->json('PUT', route("channel.update"), [
            "id" => $channel->id,
            "name" => "tell"
        ]);

        $updatedChannel = Channel::find($channel->id);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('tell', $updatedChannel->name);
    }

    /**
     * Test Channel Deleting.
     *
     * @return void
     */
    public function test_channel_delete_should_be_validated()
    {
        $response = $this->json('DELETE', route("channel.delete"), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_delete()
    {
        $channel = factory(Channel::class)->create();

        $response = $this->json("DELETE" ,route("channel.delete"), [
            'id' => $channel->id
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
