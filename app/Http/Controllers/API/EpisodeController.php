<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

use App\Episode;
use App\EpisodeDetail;
use App\StreamLink;
use App\DownloadLink;

class EpisodeController extends BaseController
{
    public function __construct() {
        $this->middleware('auth:api');
        $this->middleware('can:add episodes', ['only' => ['store']]);
        $this->middleware('can:edit episodes', ['only' => ['update']]);
        $this->middleware('can:delete episodes', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate All input fields data
        $validatedData = $request->validate([
            "details.title"             => "required",
            "details.anime_id"          => "required|numeric",
            "details.episode_number"    => "required|numeric",
            "details.title_japanese"    => "nullable",
            "details.title_romanji"     => "nullable",
            "details.notes"             => "nullable",
            "details.aired"             => "nullable|date",
            "details.filler"            => "nullable|boolean",
            "details.recap"             => "nullable|boolean",
            "details.video_url"         => "nullable|url",
            "details.forum_url"         => "nullable|url",
            "details.url"               => "nullable|url",

            "stream_links.*.name"       => "required",
            "stream_links.*.link"       => "required|url",
            
            "download_links.*.name"     => "required",
            "download_links.*.link"     => "required|url",
            
        ]);
        
        // Add the episode to Episode Povite table
        $episode = new Episode;
        $episode->anime_id = $validatedData["details"]['anime_id'];
        $episode->episode_number = $validatedData["details"]['episode_number'];
        $episode->save();
        $episode_id = $episode->id;
        
        // Add the id of the episode to insert its details
        $validatedData["details"]["episode_id"] = $episode_id;
        
        // Save the details of this episode
        EpisodeDetail::insert($validatedData["details"]);

        // Save all Streaming Server
        Streamlink::insert([
            "episode_id"    => $episode_id,
            "links"         => json_encode($validatedData["stream_links"])
        ]);

        // Save all Downloading Server
        DownloadLink::insert([
            "episode_id"    => $episode_id,
            "links"         => json_encode($validatedData["download_links"])
        ]);

        return $this->sendResponse([
            "message"       => "Inserted a new episode successfully",
            "episode_id"    => $episode_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
