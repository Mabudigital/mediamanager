<?php

use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\AudioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('playlists', PlaylistController::class);
Route::apiResource('audios', AudioController::class);
Route::get('playlist-audios/{id}', [AudioController::class, 'showPlaylistAudios']);