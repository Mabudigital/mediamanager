<?php

namespace App\Http\Controllers\Api;

use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Resources\AudiosResource;
use App\Http\Controllers\API\BaseController as BaseController;

class AudioController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Audio $audio)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function showPlaylistAudios(int $id)
    {
        
        $audios = Audio::where('playlist_id',$id)->paginate(25);
        return AudiosResource::collection($audios);
        //return $this->sendResponse(AudioResource::collection($audios), 'Playlists retrieved successfully.');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audio $audio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Audio $audio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audio $audio)
    {
        //
    }
    
}
