<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\Thread;
use App\User;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'slug' => $faker->sentence(),
        'content' => $faker->sentence(),
        'user_id' => factory(User::class)->create()->id,
        'channel_id' => factory(Channel::class)->create()->id,
    ];
});
