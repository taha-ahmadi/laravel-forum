<?php

namespace Tests\Unit;

use App\Channel;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{
    /**
     * Test Get All Channels lists 
     *
     * @return void
     */
    public function test_get_all_channel_lists()
    {
        $response = $this->get(route("channel.all"));
        
        $response->assertStatus(200);
    }

    /**
     * Test Channel no value send
     */

    public function test_channel_should_be_validated()
    {
        $response = $this->postJson(route("channel.create", []));
        
        $response->assertStatus(422);
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
}
