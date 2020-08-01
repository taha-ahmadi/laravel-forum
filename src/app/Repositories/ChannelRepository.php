<?php

namespace App\Repositories;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{

    public function create($name)
    {
        Channel::create([
            "name" => $name,
            "slug" => 'Str::slug($name)',
        ]);
    }
}
