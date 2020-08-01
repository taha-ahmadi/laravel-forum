<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ChannelRepository;

class ChannelController extends Controller
{

    public function getAllChannelList()
    {
        return response()->json(Channel::all(), 200);
    }

    public function createNewChannel(Request $request)
    {
        $request->validate([
            "name" => ['required'],
        ]);

        // Insert Channel to Database
        resolve(ChannelRepository::class)->create($request->name);

        return response()->json([
            'message' => "channe created"
        ] ,201);
    }
}
