<?php

namespace Tests\Feature;

use App\Channel;
use App\Repositories\ChannelRepository;
use App\User;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelTest extends TestCase
{

    public function registerRolesAndPermissions()
    {
        foreach(config("permission.default_roles") as $role){
            \Spatie\Permission\Models\Role::create([
                'name' => $role
            ]);
        }

        foreach(config("permission.default_permissions") as $permission){
            \Spatie\Permission\Models\Permission::create([
                'name' => $permission
            ]);
        }
    }
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
        $this->registerRolesAndPermissions();
        $user = factory(User::class)->create();
        $user->givePermissionTo('channel management');

        Sanctum::actingAs($user);

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
        // $this->registerRolesAndPermissions();
        $user = factory(User::class)->create();
        $user->givePermissionTo('channel management');

        Sanctum::actingAs($user);

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
        $user = factory(User::class)->create();
        $user->givePermissionTo('channel management');
        
        Sanctum::actingAs($user);

        $response = $this->json('PUT', route("channel.update"), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_update()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('channel management');

        $channel = factory(Channel::class)->create();

        Sanctum::actingAs($user);

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
        $user = factory(User::class)->create();
        $user->givePermissionTo('channel management');

        Sanctum::actingAs($user);

        $response = $this->json('DELETE', route("channel.delete"), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_delete()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('channel management');

        $channel = factory(Channel::class)->create();
        
        Sanctum::actingAs($user);

        $response = $this->json("DELETE", route("channel.delete"), [
            'id' => $channel->id
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
