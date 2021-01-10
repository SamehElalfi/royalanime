<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Http\Requests\AnimeRequest;

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
        $tags = [
            'action', 'adventure', 'cars', 'comedy', 'dementia',
            'demons', 'drama', 'ecchi', 'fantasy', 'game', 'harem',
            'hentai', 'historical', 'horror', 'josei', 'kids', 'magic',
            'martial arts', 'mecha', 'military', 'music', 'mystery',
            'parody', 'police', 'psychological', 'romance', 'samurai',
            'school', 'sci-fi', 'seinen', 'shoujo', 'shoujo ai', 'shounen',
            'shounen ai', 'slice of life', 'space', 'sports', 'super power',
            'supernatural', 'thriller', 'vampire', 'yaoi', 'yuri'
        ];

        return view('dashboard.animes.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimeRequest $request)
    {
        // Process all arrays like tags, opening themes
        // and english values into Arabic like anime_type and status
        // By splitting them and convert them to encoded json code
        // the next block of variables have default value as null

        // translated into arabic
        $anime_type = [
            "TV" =>  "مسلسل",
            "Movie" =>  "فيلم",
            "OVA" =>  "أوفا",
            "ONA" =>  "أونا",
            "Special" =>  "خاصة",
            "Music" =>  "موسيقى"
        ][$request->get('anime_type')];

        // Convert numeric value to text
        $source = [
            "Manga", "Original", "Light-novel", "Game", "Visual-novel",
            "Novel", "4-koma-manga", "Web-manga", "Unknown", "Other",
            "Card-game", "Music", "Book", "Digital-manga", "Picture-book",
            "Radio"
        ][$request->get('source')];

        // Convert numeric value to text
        $status = [
            'currently' => "مستمر",
            'finished' => "منتهي",
            'upcoming' => "لم يعرض بعد"
        ][$request->get('status')];

        // Convert numeric value to text and translated into arabic
        $rating = [
            "غير محدد",
            "G - كل الأعمار",
            "PG - أطفال",
            "PG-13 - مراهقين 13+",
            "R - 17+ (violence & profanity)",
            "R+ - Mild Nudity"
        ][$request->get('rating')];

        // Save Cover Image to storage
        $cover = Null;
        if ($request->has('cover')) {
            $cover = time() . '.' . request()->cover->getClientOriginalExtension();
            request()->cover->move(public_path('images'), $cover);
            $cover = cdn('images/' . $cover);
        }

        // splitted by commas (,) and translated into arabic
        $genres = $this->translateGenres($request['genres']);
        $title_synonyms = $this->jsonify($request->get('title_synonyms'));
        $broadcast = $this->translateBroadcast($request->get('broadcast'));
        $opening_themes = $this->jsonifyThemes($request->get('opening_themes'));
        $ending_themes = $this->jsonifyThemes($request->get('ending_themes'));

        // Save Anime Details in the database
        Anime::create([
            'mal_id' =>             $request->get('mal_id'),
            'url' =>                $request->get('url'),
            'image_url' =>          $request->get('image_url'),
            'cover_url' =>          $request->get('cover'),
            'trailer_url' =>        $request->get('trailer_url'),
            'title' =>              $request->get('name'),
            'title_english' =>      $request->get('title_english'),
            'title_japanese' =>     $request->get('title_japanese'),
            'episodes' =>           $request->get('episodes'),
            'aired_from' =>         $request->get('aired_from'),
            'aired_to' =>           $request->get('aired_to'),
            'duration' =>           $request->get('duration'),
            'scored_by' =>          $request->get('scored_by'),
            'rank' =>               $request->get('rank'),
            'favorites' =>          $request->get('favorites'),
            'members' =>            $request->get('members'),
            'popularity' =>         $request->get('popularity'),
            'arabic_synopsis' =>    $request->get('arabic_synopsis'),
            'background' =>         $request->get('background'),
            'synopsis' =>           $request->get('synopsis'),
            'title_synonyms' =>     $title_synonyms,
            'anime_type' =>         $anime_type,
            'source' =>             $source,
            'status' =>             $status,
            'rating' =>             $rating,
            'broadcast' =>          $broadcast,
            'genres' =>             $genres,
            'opening_themes' =>     $opening_themes,
            'ending_themes' =>      $ending_themes
        ]);

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
        // the meta tag of anime page
        $title = "مشاهدة وتحميل " . $anime->title;
        $description = $anime->arabic_synopsis;

        // Creating a list of keywords depending on anime name
        $keywords = $anime->title .
            ' أنمي, ' . $anime->title . ', ' .
            $anime->title . ' مترجم, ' .
            $anime->title_english . '  مترجم أون لاين, ';

        // Adding anime synonyms to keywords
        if (!json_decode($anime->title_synonyms) == []) {
            foreach (json_decode($anime->title_synonyms) as $synonym) {
                $keywords .= 'أنمي ' . $synonym . ' مترجم,';
            }
        }

        // Adding all anime genres to meta keywords
        if (!json_decode($anime->genres) == []) {
            foreach (json_decode($anime->genres) as $tag) {
                $keywords .= 'أنمي ' . $tag . ' مترجم,';
            }
        }

        // Canonical link element that helps webmasters prevent
        // duplicate content issues in SEO
        $canonical = url(route('animes.show', ['anime' => $anime->id, 'slug' => Str::slug($anime->title)]));

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
        // TODO Create Edit page
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
        // TODO Create Update Page
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function destroy(anime $anime)
    {
        return $anime->delete();
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

    /**
     * Translate all genres of an anime and convert the string
     * into Json code
     *
     * @param string $genres
     *
     * @return string
     */
    protected function translateGenres(String $genres)
    {
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
        return $this->jsonify($genres);
    }

    /**
     * Translate broadcast days
     *
     * @param string $broadcast
     *
     * @return string
     */
    protected function translateBroadcast(String $broadcast)
    {
        $broadcast = str_replace("Saturdays", "أيام السبت", $broadcast);
        $broadcast = str_replace("Sundays", "أيام الأحد", $broadcast);
        $broadcast = str_replace("Mondays", "أيام الاثنين", $broadcast);
        $broadcast = str_replace("Tuesdays", "أيام الثلاثاء", $broadcast);
        $broadcast = str_replace("Wednesdays", "أيام الأربعاء", $broadcast);
        $broadcast = str_replace("Thursdays", "أيام الخميس", $broadcast);
        $broadcast = str_replace("Fridays", "أيام الجمعة", $broadcast);
        $broadcast = str_replace("at", "في", $broadcast);
        $broadcast = str_replace("JST", "بتوقيت اليابان المحلي JST", $broadcast);
        return $broadcast;
    }

    /**
     * Convert a comma separated string to json code
     *
     * @param string $string
     *
     * @return string
     */
    protected function jsonify(String $string)
    {
        return json_encode(array_unique(array_filter(explode(',', $string))), JSON_UNESCAPED_UNICODE);
    }

    /**
     * Convert a line separated string to json code
     *
     * @param string $string
     *
     * @return string
     */
    protected function jsonifyThemes(String $themes)
    {
        return json_encode(array_unique(array_filter(preg_split("/\r\n|\n|\r/", $themes))));
    }
}
