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
    public function index($anime_id)
    {
        // Get the episode_id whiche used to get Episode Details
        // The next block of code will return the episode id like:
        // [1, 2, 3]
        // $episodes_ids = Episode::where('anime_id', $anime_id)->pluck('id');

        // Abort an ERROR message if no episode found
        // if (!$episodes_ids->first()) {return view('episode.not_found');}


        // $episodes = Episode::where('anime_id', $anime_id)
        // ->orderBy('episode_number')->get();
        // return $episodes;

        // Return 404 Error if no episodes found
        // if (empty($episodes)) {abort(404);}

        // Get the anime details which used in Main page heading
        // , tags and season information ... etc
        $anime = Anime::findOrFail($anime_id);

        if ($anime == null) {
            abort(404);
        }


        // The Meta tags for this episode page
        $title = "جميع حلقات مسلسل " . $anime->title;
        $description = 'جميع حلقات مسلسل ' . $anime->title
            . ' للمشاهدة والتحميل بروابط مباشرة من موقع رويال أنمي';

        $canonical = route('animes.episodes.index', ['anime' => $anime_id]);

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
    public function show($anime_id, $episode_number)
    {
        // Get the episode_id whiche used to get Episode Details
        // The next block of code will return the episode id like:
        // {"episode_id":2}
        $episode = Episode::where('anime_id', $anime_id)
            ->where('episode_number', $episode_number)->first();


        // Abort an ERROR message if no episode found
        if (!$episode) {
            abort(404);
        }
        $episode_id = $episode->id;

        if (!$episode->anime) {
            abort(404);
        }


        // Get Episode Details (e.g. title, English Title ...)
        // $episode_details = $episode->episodeDetails;

        // // Return 404 Error if no episodes found
        // if (empty($episode_details)) {abort(404);}

        // Get the anime details which used in "Next ep"
        // and "Prev ep" buttons and Main page heading
        // $anime = Anime::where('id', $anime_id)->first();


        // The Meta tags for this episode page
        $title = "الحلقة رقم " . $episode_number
            . ' من ' . $episode->anime->title;
        $description = "مشاهدة وتحميل الحلقة " . $episode_number
            . ' من ' . $episode->anime->title . ' بروابط مباشرة وبدون إعلانات مزعجة';
        $keywords = 'حلقة ' . $episode_number
            . ', ' . $episode->anime->title;

        $canonical = route('animes.episodes.show', ['anime' => $anime_id, 'episode' => $episode_number]);

        // Watching (Streaming) servers whiche used in iframe source
        // The Structure is like the following
        // episodes.episode_id (int)
        // -> episode_link.link_id (int)
        // -> links.links (text (json))
        //
        // If there is no links an error message will be handled by the view

        if (isset($episode->streamLinks['links'])) {
            $watch_links = json_decode(
                $episode->streamLinks['links']
            );
        } else {
            $watch_links = [];
        }


        // Downloading servers
        //
        // If there is no links an error message will be handled by the view
        // $download_links = $episode->link->where('type', '=', 'download');
        $download_links = json_decode(
            $episode->downloadLinks['links']
        );

        return view(
            'episode.show',
            compact(
                'title',
                'episode',
                'description',
                'watch_links',
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
        //
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
        //
    }

    /**
     * Get download links for an episode.
     * all links are available for 24 hours
     *
     * this method makes a new http request for another servers
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function download_links()
    {
        $response = Http::asForm()->post('https://www.animesilver.com/watch/getQAServer', [
            'auth' => 'Oserver',
            'ep' => 'الحلقة 05',
            'id' => '2255',
            'server' => 'Oserver',
            'c' => '1',
        ]);

        // $episode = Episode::where('anime_id', '2')
        // ->where('episode_number', '1')->first();
        // return 'as';
        return $response;
    }

    /**
     * Display a pagination of latest episodes from all animes
     *
     * @return \Illuminate\Http\Response
     */
    public function episode_list()
    {
        // Display anime list
        $paginator = Episode::latest()->paginate(52);

        // Return 404 error if there are no episodes
        if ($paginator == null) {
            abort(404);
        }

        $primary_nav = true;
        $title = 'قائمة الحلقات';
        $description = 'أكبر قائمة للأنمي على الأطلاق مقدمة حصريًأ من موقع رويال أنمي';

        $canonical = route('episodes');
        return view('episode.episode_list', compact('paginator', 'primary_nav', 'title', 'description', 'canonical'));
    }
}
