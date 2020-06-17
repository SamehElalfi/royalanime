<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\EpisodeDetail;
use App\StreamLink;
use App\Anime;

class ServerController extends Controller
{
    public function __construct() {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * Example of the request body
     * [
     *     {
     *         "mal_id":1,
     *         "episodes": [
     *             {"number":1, "urls":[{"link":"https://site-one.com", "name":"google"},{"link":"https://site-two.com", "name":"wiki"}]},
     *             {"number":2, "urls":[{"link":"https://site-one.com", "name":"google"},{"link":"https://site-two.com", "name":"wiki"}]}
     *         ]
     *     }
     * ]
     */
    public function add(Request $request)
    {
        foreach ($request->all() as $anime) {
            $anime_id = Anime::withTrashed()->where('mal_id','=',$anime['mal_id'])->pluck('id');

            foreach ($anime['episodes'] as $episode) {
                $episode_id = EpisodeDetail::withTrashed()->where('mal_id', '=', $anime_id)
                ->where('episode_number', '=', $episode['number'])
                ->pluck('episode_id');

                $old_urls = json_decode(StreamLink::where('episode_id', '=', $episode_id)->first('links')['links']);

                $all_urls = array();

                foreach ($old_urls as $value) {
                    array_push($all_urls, $value);
                }
                foreach ($episode['urls'] as $value) {
                    array_push($all_urls, $value);
                }

                StreamLink::where('episode_id', '=', $episode_id)->update(['links'=>$all_urls]);
                // return $all_urls;
            }
        }
        return true
    }
}
