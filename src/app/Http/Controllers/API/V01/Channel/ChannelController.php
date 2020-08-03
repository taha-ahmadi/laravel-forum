<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ChannelRepository;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Ternary;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{

     /**
     * Get All Channels
     * @return JsonResponse
     */
    public function getAllChannelsList()
    {
        $all_channels = resolve(ChannelRepository::class)->all();
        
        return response()->json($all_channels, Response::HTTP_OK);
    }

     /**
     * Create Channel(s)
     * @param Request $request
     * @return JsonResponse
     */
    public function createNewChannel(Request $request)
    {
        $request->validate([
            "name" => ['required'],
        ]);

        // Insert Channel to Database
        resolve(ChannelRepository::class)->create($request);

        return response()->json([
            'message' => "channel created"
        ] , Response::HTTP_CREATED);
    }

     /**
     * Update Channel
     * @param Request $request
     * @return JsonResponse
     */
    public function updateChannel(Request $request)
    {
        $request->validate([
            "name" => ['required'],
        ]);

        // Update channel from Dsatabase
        resolve(ChannelRepository::class)->update($request);

        return response()->json([
            'message' => 'channel edited'
        ], Response::HTTP_OK);
    }

    /**
     * Delete Channel(s)
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteChannel(Request $request)
    {

        $request->validate([
            'id' => ['required']
        ]);

        // Delete Channel
        resolve(ChannelRepository::class)->delete($request);

        return response()->json([
            'message' => 'channel deleted'
        ], Response::HTTP_OK);
    }
}
