<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

use App\Episode;
// use App\EpisodeDetail;
use App\StreamLink;
use App\DownloadLink;
use App\Http\Controllers\API\ServerController;

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
            
            "download_links.*.name"     => "nullable",
            "download_links.*.link"     => "nullable|url"
            
        ]);

        $data =  $validatedData["details"];
        
        // Save the details of this episode
        $episodeQuery = Episode::where("anime_id", '=', $data["anime_id"])
        ->where("episode_number", '=', $data["episode_number"]);
        
        $episode = $episodeQuery->first();

        if ($episode == null) {
            $episode = Episode::withTrashed()->where("anime_id", '=', $data["anime_id"])
            ->where("episode_number", '=', $data["episode_number"])->first();
            if ($episode != null) {
                $episode->restore();
            } else {
                $episode = new Episode;
            }
        }

        $episode->anime_id          = $data["anime_id"];
        $episode->episode_number    = $data["episode_number"];
        $episode->filler            = $data["filler"];
        $episode->recap             = $data["recap"];
        $episode->video_url         = $data["video_url"];
        $episode->forum_url         = $data["forum_url"];
        $episode->title             = $data["title"];
        $episode->title_japanese    = $data["title_japanese"];
        $episode->title_romanji     = $data["title_romanji"];
        $episode->save();

        $episode_id = $episode->id;

        // Save all Streaming Server
        if (array_key_exists('stream_links', $validatedData)) {
            try {
                Streamlink::insert([
                    "episode_id"    => $episode_id,
                    "links"         => json_encode($validatedData["stream_links"])
                ]);
            } catch (\Exception $e) {

            }
            // $streamlink = Streamlink::where("episode_id", "=", $episode_id);
            // if ($streamlink->first() == null) {
            //     Streamlink::insert([
            //         "episode_id"    => $episode_id,
            //         "links"         => json_encode($validatedData["stream_links"])
            //     ]);
            // } else {
            //     $old_links = json_decode($streamlink->first()->links);
            //     $old_links_raw = [];
            //     // return json_encode($old_links[0]->link);

            //     foreach ($old_links as $value) {
            //         array_push($old_links_raw, $value->link);
            //     }
            //     // return $old_links_raw;

            //     $new_links = [];

            //     foreach ($validatedData["stream_links"] as $link) {
            //         if (!array_key_exists($link["link"], $old_links_raw)) {
            //             array_push($new_links, $link);
            //         }
            //     }
            //     $all_links = array_merge($old_links, $new_links);
            //     // return $all_links;

            //     StreamLink::where("episode_id", "=", $episode_id)->update([
            //         'links' => json_encode(
            //             $all_links
            //             )
            //         ]);
            // }
        }

        // Save all Downloading Server
        if (array_key_exists('download_links', $validatedData)) {
            try {
                DownloadLink::insert([
                    "episode_id"    => $episode_id,
                    "links"         => json_encode($validatedData["download_links"])
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

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
