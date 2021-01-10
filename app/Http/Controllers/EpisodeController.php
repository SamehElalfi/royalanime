<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class EpisodeController extends Controller
{
    public function __construct()
    {
        // Cache the final page  as html file in /public/page-cache/
        $this->middleware('page-cache', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Anime $anime)
    {
        // The Meta tags for this episode page
        $title = "مشاهدة وتحميل " . $anime->title;
        $description = 'مشاهدة وتحميل ' . $anime->title
            . ' بروابط مباشرة من موقع رويال أنمي';

        // Canonical link element that helps webmasters prevent
        // duplicate content issues in SEO
        $canonical = route('animes.episodes.index', ['anime' => $anime->id]);

        return view(
            'episode.index',
            compact('anime', 'title', 'description', 'canonical')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO Make Create Episode Page
        return 'create ep';
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
     * The request will be like /animes/21/episodes/10/{slug?}
     *
     * @param  $anime_id and $episode_number
     * @return \Illuminate\Http\Response
     */
    public function show(Anime $anime, $episode_number)
    {
        // Get the episode_id which used to get Episode Details
        // The next block of code will return the episode id like:
        // {"episode_id":2}
        $episode = Episode::where('anime_id', $anime->id)
            ->where('episode_number', $episode_number)->firstOrFail();

        // The Meta tags for this episode page
        $title = "الحلقة رقم " . $episode_number . ' من ' . $episode->anime->title;
        $description = "مشاهدة وتحميل الحلقة " . $episode_number
            . ' من ' . $episode->anime->title . ' بروابط مباشرة وبدون إعلانات مزعجة';
        $keywords = 'حلقة ' . $episode_number . ', ' . $episode->anime->title;

        // Canonical link element that helps webmasters prevent
        // duplicate content issues in SEO
        $canonical = route('animes.episodes.show', ['anime' => $anime->id, 'episode' => $episode_number]);

        // Watching (Streaming) servers which used in iframe source
        // The Structure is like the following
        // episodes.episode_id (int)
        // -> stream_links.links (json)
        //
        // If there is no links an error message will be handled by the view
        $stream_links = json_decode($episode->streamLinks['links']);


        // Downloading servers
        // It work the same like stream links
        //
        // If there is no links an error message will be handled by the view
        $download_links = json_decode($episode->downloadLinks['links']);

        return view(
            'episode.show',
            compact(
                'title',
                'episode',
                'description',
                'stream_links',
                'download_links',
                'canonical'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(episode $episode)
    {
        // TODO Create edit episode page
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(episode $episode)
    {
        return $episode->delete();
    }

    /**
     * Display a pagination of latest episodes from all animes
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        // Display anime list
        $paginator = Episode::latest()->paginate(52);

        // Return 404 error if there are no episodes
        $paginator == null ? abort(404) : '';

        $primary_nav = true;
        $title = 'قائمة الحلقات';
        $description = 'أكبر قائمة للأنمي على الأطلاق مقدمة حصريًأ من موقع رويال أنمي';
        $canonical = route('animes.episodes.list');

        return view('episode.list', compact('paginator', 'primary_nav', 'title', 'description', 'canonical'));
    }
}
