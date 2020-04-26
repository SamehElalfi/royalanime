<?php

namespace App\Http\Controllers;

use App\episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($anime)
    {
        $episodes = \App\Episode::where('mal_id', $anime)
        ->orderBy('episode_number')
        ->get();

        // dd($episodes);

        // Return 404 Error if no episodes found
        if (empty($episodes->toArray())) {abort(404);}

        $anime = \App\Anime::where('id', $anime)->first();
        
        // Meta Tags
        $title = "جميع حلقات مسلسل " . $anime->title;
        $description = 'جميع حلقات مسلسل ' . $anime->title . ' للمشاهدة والتحميل بروابط مباشرة من موقع رويال أنمي';

        return view('episode.index', compact('episodes', 'anime', 'title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show($anime, $episode)
    {
        $episode = \App\Episode::where('mal_id', $anime)
            ->where('episode_number', $episode)
            ->first();
        
        // If episode is not found
        if (!$episode){abort(404);}

        // Get the anime details which used in "Next ep" and "Prev ep" buttons
        $anime = \App\Anime::where('id', $anime)->first();

        // dd($anime);
        
        // The Meta tags for this episode
        $title = "الحلقة رقم " . $episode->episode_number . ' من مسلسل ' . $anime->title;
        $description = "مشاهدة وتحميل الحلقة " . $episode->episode_number . ' من مسلسل ' . $anime->title . ' بروابط مباشرة وبدون إعلانات مزعجة';
        
        // Watching and downloading servers links
        $watch_links = $episode->link->where('type', '=', 'watch');
        $download_links = $episode->link->where('type', '=', 'download');

        // dd(empty($watch_links));
        return view('episode.show', compact('episode', 'anime', 'title', 'description', 'watch_links', 'download_links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(episode $episode)
    {
        //
    }
}
