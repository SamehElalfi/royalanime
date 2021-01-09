<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    public function __construct()
    {
        // Cache the final page  as html file in /public/page-cache/
        $this->middleware('page-cache', ['only' => ['show']]);

        $this->middleware('auth', ['only' => ['create', 'edit', 'store']]);
        $this->middleware('can:add animes', ['only' => ['create']]);
        $this->middleware('can:edit animes', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete animes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy');
        $sortBy = in_array($sortBy, ['title', 'score', 'date']) ? $sortBy : 'title';

        $order = $request->input('order');
        $order = in_array($order, ['DESC', 'ASC']) ? $order : 'ASC';

        if ($sortBy == 'date') {
            // Display anime list
            $paginator = Anime::orderBy('aired_from', $order)->paginate(10);
            $paginator = $paginator->appends(['sortBy' => 'date', 'order' => $order]);
        } else {
            // Display anime list
            $paginator = Anime::orderBy($sortBy, $order)->paginate(10);
            $paginator = $paginator->appends(['sortBy' => $sortBy, 'order' => $order]);
        }

        // Return 404 error if there are no animes
        $paginator == null ? abort(404) : null;

        $primary_nav = true;
        $title = 'قائمة الأنمي';
        $description = 'أكبر قائمة الأنمي على الأطلاق مقدمة حصريًا من موقع رويال أنمي';
        return view('anime.index', compact('paginator', 'primary_nav', 'title', 'description', 'sortBy', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = ['action', 'adventure', 'cars', 'comedy', 'dementia', 'demons', 'drama', 'ecchi', 'fantasy', 'game', 'harem', 'hentai', 'historical', 'horror', 'josei', 'kids', 'magic', 'martial arts', 'mecha', 'military', 'music', 'mystery', 'parody', 'police', 'psychological', 'romance', 'samurai', 'school', 'sci-fi', 'seinen', 'shoujo', 'shoujo ai', 'shounen', 'shounen ai', 'slice of life', 'space', 'sports', 'super power', 'supernatural', 'thriller', 'vampire', 'yaoi', 'yuri'];

        // $tags = ['animes', 'episodes', 'actions'];
        return view('dashboard.animes.create', compact('tags'));
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
            "arabic_synopsis" => "nullable",
            "anime_type" => "in:TV,Movie,OVA,ONA,Special,Music",
            "aired_from" => "nullable|date",
            "aired_to" => "nullable|date",
            "background" => "nullable",
            "broadcast" => "nullable",
            "cover" => "image|mimes:jpeg,png,jpg,gif,svg",
            "duration" => "nullable",
            "ending_themes" => "nullable",
            "episodes" => "nullable",
            "favorites" => "nullable",
            "genres" => "nullable",
            "image_url" => "nullable",
            "mal_id" => "numeric",
            "members" => "nullable",
            "name" => "required",
            "opening_themes" => "nullable",
            "popularity" => "nullable",
            "rank" => "nullable",
            "rating" => "numeric|between:0,5",
            "source" => "numeric|between:0,15",
            "status" => "in:airing,finished,upcoming",
            "scored_by" => "nullable",
            "synopsis" => "nullable",
            "title_english" => "nullable",
            "title_japanese" => "nullable",
            "title_synonyms" => "nullable",
            "trailer_url" => "nullable",
            "url" => "nullable"
        ]);

        // Process all arrays like tags, opening themes
        // and english values into Arabic like anime_type and status
        // By splitting them and convert them to encoded json code
        // the next block of variables have default value as null
        $genres = $request['genres'];   // splited by commas (,) and translated into arabic
        $title_synonyms = $request['title_synonyms'];   // splited by commas (,)
        $anime_type = $request['anime_type'];   // translated into arabic
        $source = $request['source'];   // Convert numric value to text
        $status = $request['status'];   // translated into arabic
        $rating = $request['rating'];   // Convert numric value to text and translated into arabic
        $broadcast = $request['broadcast']; // translated into arabic
        $opening_themes = $request['opening_themes'];   // splited by new line (\r\n, \r, \n)
        $ending_themes = $request['ending_themes']; // splited by new line (\r\n, \r, \n)

        if ($request->has('genres')) {
            $genres = $request['genres'];
            $genres = str_replace('Action', 'أكشن', $genres);
            $genres = str_replace('Adventure', 'مغامرات', $genres);
            $genres = str_replace('Cars', 'سيارات', $genres);
            $genres = str_replace('Comedy', 'كوميدي ', $genres);
            $genres = str_replace('Dementia', 'جنوني', $genres);
            $genres = str_replace('Demons', 'شياطين', $genres);
            $genres = str_replace('Drama', 'دراما', $genres);
            $genres = str_replace('Ecchi', 'إتشي', $genres);
            $genres = str_replace('Fantasy', 'فانتازيا', $genres);
            $genres = str_replace('Game', 'ألعاب', $genres);
            $genres = str_replace('Harem', 'حريم', $genres);
            $genres = str_replace('Hentai', 'هينتاي', $genres);
            $genres = str_replace('Historical', 'تاريخي', $genres);
            $genres = str_replace('Horror', 'رعب', $genres);
            $genres = str_replace('Josei', 'جوسي', $genres);
            $genres = str_replace('Kids', 'طفولي', $genres);
            $genres = str_replace('Magic', 'سحر', $genres);
            $genres = str_replace('Martial Arts', 'فنون', $genres);
            $genres = str_replace('Mecha', 'آلات', $genres);
            $genres = str_replace('Military', 'عسكري', $genres);
            $genres = str_replace('Music', 'موسيقي', $genres);
            $genres = str_replace('Mystery', 'غموض', $genres);
            $genres = str_replace('Parody', 'ساخر', $genres);
            $genres = str_replace('Police', 'بوليسي', $genres);
            $genres = str_replace('Psychological', 'نفسي', $genres);
            $genres = str_replace('Romance', 'رومانسي', $genres);
            $genres = str_replace('Samurai', 'ساموراي', $genres);
            $genres = str_replace('School', 'مدرسي', $genres);
            $genres = str_replace('Sci-Fi', 'خيال علمي', $genres);
            $genres = str_replace('Seinen', 'سينن', $genres);
            $genres = str_replace('Shoujo Ai', 'شوجو', $genres);
            $genres = str_replace('Shoujo', 'شوجو', $genres);
            $genres = str_replace('Shounen Ai', 'شونين', $genres);
            $genres = str_replace('Shounen', 'شونين', $genres);
            $genres = str_replace('Slice of Life', 'شريحة من الحباة', $genres);
            $genres = str_replace('Space', 'فضاء', $genres);
            $genres = str_replace('Sports', 'رياضي', $genres);
            $genres = str_replace('Super Power', 'قوى خارقة', $genres);
            $genres = str_replace('Supernatural', 'خارق للطبيعة', $genres);
            $genres = str_replace('Thriller', 'إثارة', $genres);
            $genres = str_replace('Vampire', 'مصاصي دماء', $genres);
            $genres = str_replace('Yaoi', 'يوي', $genres);
            $genres = str_replace('Yuri', 'يوري', $genres);
            $genres = json_encode(array_unique(array_filter(explode(',', $genres))), JSON_UNESCAPED_UNICODE);
        }
        if ($request->has('title_synonyms')) {
            $title_synonyms = json_encode(array_unique(array_filter(explode(',', $request['title_synonyms']))));
        }
        if ($request->has('anime_type')) {
            switch ($request->anime_type) {
                case "TV":
                    $anime_type = "مسلسل";
                    break;
                case "Movie":
                    $anime_type = "فيلم";
                    break;
                case "OVA":
                    $anime_type = "أوفا";
                    break;
                case "ONA":
                    $anime_type = "أونا";
                    break;
                case "Special":
                    $anime_type = "خاصة";
                    break;
                case "Music":
                    $anime_type = "موسيقى";
                    break;
                default:
                    $anime_type = NULL;
            }
        }
        if ($request->has('source')) {
            switch ($request->source) {
                case 0:
                    $source = "Manga";
                    break;
                case 1:
                    $source = "Original";
                    break;
                case 2:
                    $source = "Light-novel";
                    break;
                case 3:
                    $source = "Game";
                    break;
                case 4:
                    $source = "Visual-novel";
                    break;
                case 5:
                    $source = "Novel";
                    break;
                case 6:
                    $source = "4-koma-manga";
                    break;
                case 7:
                    $source = "Web-manga";
                    break;
                case 8:
                    $source = "Unknown";
                    break;
                case 9:
                    $source = "Other";
                    break;
                case 10:
                    $source = "Card-game";
                    break;
                case 11:
                    $source = "Music";
                    break;
                case 12:
                    $source = "Book";
                    break;
                case 13:
                    $source = "Digital-manga";
                    break;
                case 14:
                    $source = "Picture-book";
                    break;
                case 15:
                    $source = "Radio";
                    break;
                default:
                    $source = NULL;
            }
        }
        if ($request->has('status')) {
            switch ($request->status) {
                case 'currently':
                    $status = "مستمر";
                    break;
                case 'finished':
                    $status = "منتهي";
                    break;
                case 'upcoming':
                    $status = "لم يعرض بعد";
                    break;
                default:
                    $status = NULL;
            }
        }
        if ($request->has('rating')) {
            switch ($request->rating) {
                case 0:
                    $rating = "غير محدد";
                    break;
                case 1:
                    $rating = "G - كل الأعمار";
                    break;
                case 2:
                    $rating = "PG - أطفال";
                    break;
                case 3:
                    $rating = "PG-13 - مراهقين 13+";
                    break;
                case 4:
                    $rating = "R - 17+ (violence & profanity)";
                    break;
                case 5:
                    $rating = "R+ - Mild Nudity";
                    break;
                default:
                    $rating = NULL;
            }
        }
        if ($request->has('broadcast')) {
            $broadcast = $request['broadcast'];
            $broadcast = str_replace("Saturdays", "أيام السبت", $broadcast);
            $broadcast = str_replace("Sundays", "أيام الأحد", $broadcast);
            $broadcast = str_replace("Mondays", "أيام الاثنين", $broadcast);
            $broadcast = str_replace("Tuesdays", "أيام الثلاثاء", $broadcast);
            $broadcast = str_replace("Wednesdays", "أيام الأربعاء", $broadcast);
            $broadcast = str_replace("Thursdays", "أيام الخميس", $broadcast);
            $broadcast = str_replace("Fridays", "أيام الجمعة", $broadcast);
            $broadcast = str_replace("at", "في", $broadcast);
            $broadcast = str_replace("JST", "بتوقيت اليابان المحلي JST", $broadcast);
        }
        if ($request->has('opening_themes')) {
            $opening_themes = json_encode(array_unique(array_filter(preg_split("/\r\n|\n|\r/", $request['opening_themes']))));
        }
        if ($request->has('ending_themes')) {
            $ending_themes = json_encode(array_unique(array_filter(preg_split("/\r\n|\n|\r/", $request['ending_themes']))));
        }

        $name = $request['name'];
        $mal_id = $request['mal_id'];
        $arabic_synopsis = $request['arabic_synopsis'];
        $title_english = $request['title_english'];
        $title_japanese = $request['title_japanese'];
        $aired_from = $request['aired_from'];
        $aired_to = $request['aired_to'];
        $duration = $request['duration'];
        $background = $request['background'];
        $synopsis = $request['synopsis'];
        $episodes = $request['episodes'];

        if ($request->has('cover')) {
            $cover = time() . '.' . request()->cover->getClientOriginalExtension();
            request()->cover->move(public_path('images'), $cover);
            $cover = cdn('images/' . $cover);
        } else {
            $cover = Null;
        }

        // Additional Information and details
        $favorites = $request['favorites'];
        $image_url = $request['image_url'];
        $members = $request['members'];
        $popularity = $request['popularity'];
        $rank = $request['rank'];
        $scored_by = $request['scored_by'];
        $trailer_url = $request['trailer_url'];
        $url = $request['url'];

        // Save Anime Details in the database
        $anime = new Anime;

        $anime->title = $name;
        $anime->mal_id = $mal_id;
        $anime->arabic_synopsis = $arabic_synopsis;
        $anime->genres = $genres;
        $anime->title_english = $title_english;
        $anime->title_japanese = $title_japanese;
        $anime->title_synonyms = $title_synonyms;
        $anime->anime_type = $anime_type;
        $anime->source = $source;
        $anime->status = $status;
        $anime->aired_from = $aired_from;
        $anime->aired_to = $aired_to;
        $anime->duration = $duration;
        $anime->rating = $rating;
        $anime->background = $background;
        $anime->synopsis = $synopsis;
        $anime->broadcast = $broadcast;
        $anime->opening_themes = $opening_themes;
        $anime->ending_themes = $ending_themes;
        $anime->cover_url = $cover;
        $anime->episodes = $episodes;
        $anime->favorites = $favorites;
        $anime->image_url = $image_url;
        $anime->members = $members;
        $anime->popularity = $popularity;
        $anime->rank = $rank;
        $anime->scored_by = $scored_by;
        $anime->trailer_url = $trailer_url;
        $anime->url = $url;
        $anime->save();
        // return $anime;
        return back()->with('main', __('dashboard.A new anime added to database successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function show(anime $anime)
    {
        // dd($anime->episodesList);
        // the meta tag of anime page
        $title = "مشاهدة وتحميل " . $anime->title;
        $description = $anime->arabic_synopsis;

        // Creating a list of tags depinding on anime name
        $keywords = $anime->title .
            ' أنمي, ' . $anime->title . ', ' .
            $anime->title . ' مترجم, ' .
            $anime->title_english . '  مترجم أون لاين, ';

        // Adding anime synonyms to tags
        if (!json_decode($anime->synonyms) == []) {
            foreach (json_decode($anime->synonyms) as $synonym) {
                $keywords = $keywords . 'أنمي ' . $synonym . 'مترجم';
            }
        }

        // Adding all anime genres to meta tags
        if ($anime->genres) {
            if (!json_decode($anime->genres)) {
                foreach (json_decode($anime->genres) as $tag) {
                    $keywords = $keywords . 'أنمي ' . $tag . 'مترجم';
                }
            }
        }

        $canonical = url(route('animes.show', ['anime' => $anime->id, 'slug' => Str::slug($anime->title)]));
        // return $canonical;
        // anime variable is passd to this function
        return view('anime.show', compact('anime', 'title', 'description', 'keywords', 'canonical'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function edit(anime $anime)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, anime $anime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function destroy(anime $anime)
    {
        //
    }

    /**
     * Redirect to random resource .
     *
     * @param  \App\Models\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        $anime = Anime::inRandomOrder()->first();
        return redirect(route('animes.show', ['anime' => $anime->id]));
    }
}
