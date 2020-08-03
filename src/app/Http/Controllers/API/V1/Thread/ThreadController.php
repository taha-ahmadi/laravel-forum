<?php

namespace App\Http\Controllers\API\V1\Thread;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\ThreadRepository;
use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    /**
     * Get All Threads
     * @return JsonResponse
     */
    public function index()
    {
        $threads = resolve(ThreadRepository::class)->getAllAvailableThreads();

        return response()->json($threads, Response::HTTP_OK);
    }

    /**
     * Show Thread
     * @param $slug
     * @return JsonResponse
     */
    public function show($slug)
    {
        $thread = resolve(ThreadRepository::class)->getThreadBySlug($slug);

        return response()->json($thread, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => 'required',
            "content" => 'required',
            "channel_id" => 'required',
        ]);

        // Add Thread
        resolve(ThreadRepository::class)->store($request);

        return response()->json([
            'message' => 'Thread created'
        ], Response::HTTP_CREATED);
    }

    public function update(Thread $thread, Request $request)
    {
        $request->validate([
            "title" => 'required',
            "content" => 'required',
            "channel_id" => 'required',
        ]);

        // Add Thread
        resolve(ThreadRepository::class)->update($thread, $request);

        return response()->json([
            'message' => 'Thread updated'
        ], Response::HTTP_OK);
    }
}