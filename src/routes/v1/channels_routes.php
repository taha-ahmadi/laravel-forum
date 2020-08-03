<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V01\Auth\AuthController;

Route::prefix('/channel')->group(function () {
    Route::get('/all', [
        ChannelController::class,
        'getAllChannelsList'
    ])->name('channel.all');

    Route::middleware(['can:channel management', 'auth:sanctum'])->group(function () {
        Route::post('/create', [
            ChannelController::class,
            'createNewChannel'
        ])->name('channel.create');

        Route::put('/update', [
            ChannelController::class,
            'updateChannel'
        ])->name('channel.update');

        Route::delete('/delete', [
            ChannelController::class,
            'deleteChannel'
        ])->name('channel.delete');
    });
});