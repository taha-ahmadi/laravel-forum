<?php

namespace App\Repositories;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{

     /**
     * Get All Channels
     * @return Channel
     */
    public function all()
    {
        return Channel::all();
    }

    /**
     * Create Channel
     * @param $request
     */
    public function create(Request $request)
    {
        Channel::create([
            "name" => $request->name,
            "slug" => 'Str::slug($name)',
        ]);
    }

    /**
     * Update Channel
     * @param $request
     */
    public function update(Request $request)
    {
        $channel = Channel::find($request->id);

        $channel->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
    }

    /**
     * Delete Channel
     * @param $request
     */
    public function delete(Request $request)
    {
        Channel::destroy($request->id);
    }
}
