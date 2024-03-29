<?php

namespace App\Http\Controllers\Api;

use App\Models\Audio;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AudioResource;
use App\Http\Resources\PlaylistResource;
use App\Http\Controllers\API\BaseController as BaseController;

class PlaylistController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $playlists = Playlist::paginate(25)->all();
       // return $this->sendResponse(PlaylistResource::collection($playlists), 'Playlists retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
       // Retrieve the playlist data
    $playlist = Playlist::with('audios')->find($playlist->id);

    // Paginate the audios relationship within the playlist
    $audios = $playlist->audios()->paginate(10);

    // Append paginated audios to the playlist data
    $playlist->audios = $audios->items();

    return response()->json([
        'playlist' => $playlist,
    ]);
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
