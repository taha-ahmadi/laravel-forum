<?php

namespace App\Repositories;

use App\Thread;
use Illuminate\Support\Str;

class ThreadRepository{

    public function getAllAvailableThreads()
    {
        return Thread::where('flag',1)->latest()->get();
    }

    /**
     * @param $slug
     */
    public function getThreadBySlug($slug)
    {
        return Thread::where('slug', $slug)->where('flag', 1)->first();
    }

    /**
     * Add New Thread
     * @param Request $request
     */
    public function store($request)
    {
        Thread::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "content" => $request->content,
            "channel_id" => $request->channel_id,
            "user_id" => auth()->user()->id,
        ]);
    }

    /**
     * Modify New Thread
     * @param Request $request
     */
    public function update($thread, $request)
    {
        $thread->update([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "content" => $request->content,
            "channel_id" => $request->channel_id,
            "user_id" => auth()->user()->id,
        ]);
    }
}