<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

use App\Anime;
class AnimeController extends BaseController
{
    public function __construct() {
        $this->middleware('auth:api');
        $this->middleware('can:add animes', ['only' => ['store']]);
        $this->middleware('can:edit animes', ['only' => ['update']]);
        $this->middleware('can:delete animes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Test Method
        // $animes = Anime::all();
        $animes = Anime::orderBy('aired_from', 'ASC')->paginate(10);
        return $this->sendREsponse($animes->toArray(), "Anime sent successfully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate that every single information is correct
        $validatedData = $this->validate_anime_data($request);

        // Save Anime Details in the database
        Anime::insert($validatedData);

        return $this->sendResponse('Inserted new anime successfully');
    }

    /**
     * Validate all columns of an anime before inserting it
     *
     * Process all arrays like tags, opening themes
     * and translate english values into Arabic like anime_type and status
     * Then splitting them and convert them to encoded json code
     * 
     * @param  Request $request
     * @return Array $validatedData
     */
    protected function validate_anime_data(Request $request)
    {
        // Validate All input fields data
        $validatedData = $request->validate([
            "arabic_synopsis"   => "nullable",
            "anime_type"        => "in:TV,Movie,OVA,ONA,Special,Music",
            "aired_from"        => "nullable|date",
            "aired_to"          => "nullable|date",
            "background"        => "nullable",
            "broadcast"         => "nullable",
            "cover"             => "image|mimes:jpeg,png,jpg,gif,svg",
            "duration"          => "nullable",
            "ending_themes"     => "nullable",
            "episodes"          => "nullable|int",
            "favorites"         => "nullable|int",
            "genres"            => "nullable",
            "image_url"         => "nullable",
            "mal_id"            => "numeric|int",
            "members"           => "nullable|int",
            "title"             => "required",
            "opening_themes"    => "nullable",
            "popularity"        => "nullable|int",
            "rank"              => "nullable|numeric",
            "rating"            => "numeric|between:0,5",
            "source"            => "numeric",
            "status"            => "in:airing,finished,upcoming",
            "scored_by"         => "nullable|int",
            "synopsis"          => "nullable",
            "title_english"     => "nullable",
            "title_japanese"    => "nullable",
            "title_synonyms"    => "nullable",
            "trailer_url"       => "nullable|url",
            "url"               => "nullable|url"
        ]);
        $validatedData = $request;

        // Translate all genres to Arabic
        // splited by commas (,) and translated into arabic
        if ($validatedData->has('genres')) {
            $genres = $validatedData['genres'];

            // The words that will be translated
            $translateWords = array(
                'Action'           => 'أكشن',
                'Adventure'        => 'مغامرات',
                'Cars'             => 'سيارات',
                'Comedy'           => 'كوميدي ',
                'Dementia'         => 'جنوني',
                'Demons'           => 'شياطين',
                'Drama'            => 'دراما',
                'Ecchi'            => 'إتشي',
                'Fantasy'          => 'فانتازيا',
                'Game'             => 'ألعاب',
                'Harem'            => 'حريم',
                'Hentai'           => 'هينتاي',
                'Historical'       => 'تاريخي',
                'Horror'           => 'رعب',
                'Josei'            => 'جوسي',
                'Kids'             => 'طفولي',
                'Magic'            => 'سحر',
                'Martial Arts'     => 'فنون',
                'Mecha'            => 'آلات',
                'Military'         => 'عسكري',
                'Music'            => 'موسيقي',
                'Mystery'          => 'غموض',
                'Parody'           => 'ساخر',
                'Police'           => 'بوليسي',
                'Psychological'    => 'نفسي',
                'Romance'          => 'رومانسي',
                'Samurai'          => 'ساموراي',
                'School'           => 'مدرسي',
                'Sci-Fi'           => 'خيال علمي',
                'Seinen'           => 'سينن',
                'Shoujo Ai'        => 'شوجو',
                'Shoujo'           => 'شوجو',
                'Shounen Ai'       => 'شونين',
                'Shounen'          => 'شونين',
                'Slice of Life'    => 'شريحة من الحباة',
                'Space'            => 'فضاء',
                'Sports'           => 'رياضي',
                'Super Power'      => 'قوى خارقة',
                'Supernatural'     => 'خارق للطبيعة',
                'Thriller'         => 'إثارة',
                'Vampire'          => 'مصاصي دماء',
                'Yaoi'             => 'يوي',
                'Yuri'             => 'يوري'
            );

            $genres = str_replace(
                array_keys($translateWords), 
                array_values($translateWords), 
                $genres
            );
            
            // Remove duplicate words and translate the string into json code
            $validatedData['genres'] = json_encode(
                array_unique(
                    array_filter(
                        explode(',', $genres)
                    )
                ), JSON_UNESCAPED_UNICODE
            );
        }

        // Remove duplicated title synonyms
        // splited by commas (,) and translated into arabic
        if ($validatedData->has('title_synonyms')) {
            $validatedData['title_synonyms'] = json_encode(
                array_unique(
                    array_filter(
                        explode(',', $validatedData['title_synonyms'])
                    )
                )
            );
        }

        // Translate anime type into Arabic (default: Null)
        if ($validatedData->has('anime_type')) {
            switch ($validatedData->anime_type) {
                case "TV":
                    $validatedData->anime_type = "مسلسل";
                    break;
                case "Movie":
                    $validatedData->anime_type = "فيلم";
                    break;
                case "OVA":
                    $validatedData->anime_type = "أوفا";
                    break;
                case "ONA":
                    $validatedData->anime_type = "أونا";
                    break;
                case "Special":
                    $validatedData->anime_type = "خاصة";
                    break;
                case "Music":
                    $validatedData->anime_type = "موسيقى";
                    break;
                default:
                    $validatedData->anime_type = NULL;
            }
        }

        // Translate status of the anime (default: Null)
        if ($validatedData->has('status')) {
            switch ($validatedData->status) {
                case 'currently':
                    $validatedData->status = "مستمر";
                    break;
                case 'finished':
                    $validatedData->status = "منتهي";
                    break;
                case 'upcoming':
                    $validatedData->status = "لم يعرض بعد";
                    break;
                default:
                    $validatedData->status = NULL;
            }
        }

        // Set the rating (age) of the anime (default: Null)
        if ($validatedData->has('rating')) {
            switch ($validatedData->rating) {
                case 0:
                    $validatedData->rating = "غير محدد";
                    break;
                case 1:
                    $validatedData->rating = "G - كل الأعمار";
                    break;
                case 2:
                    $validatedData->rating = "PG - أطفال";
                    break;
                case 3:
                    $validatedData->rating = "PG-13 - مراهقين 13+";
                    break;
                case 4:
                    $validatedData->rating = "R - 17+ (violence & profanity)";
                    break;
                case 5:
                    $validatedData->rating = "R+ - Mild Nudity";
                    break;
                default:
                    $validatedData->rating = NULL;
            }
        }

        // Translate broadcast
        if ($validatedData->has('broadcast')) {
            // The words that will be translates
            $translateWords = array(
                "Saturdays"     => "أيام السبت",
                "Sundays"       => "أيام الأحد",
                "Mondays"       => "أيام الاثنين",
                "Tuesdays"      => "أيام الثلاثاء",
                "Wednesdays"    => "أيام الأربعاء",
                "Thursdays"     => "أيام الخميس",
                "Fridays"       => "أيام الجمعة",
                "at"            => "في",
                "JST"           => "بتوقيت اليابان المحلي JST"
            );

            $validatedData->broadcast = str_replace(
                array_keys($translateWords), 
                array_values($translateWords), 
                $validatedData->broadcast
            );
        }

        // Split OSTs into arrays and remove duplicated ones
        // splited by new line (\r\n, \r, \n)
        if ($validatedData->has('opening_themes')) {
            $validatedData->opening_themes = json_encode(
                array_unique(
                    array_filter(
                        preg_split("/\r\n|\n|\r/", $validatedData['opening_themes'])
                    )
                )
            );
        }
        if ($validatedData->has('ending_themes')) {
            $validatedData->ending_themes = json_encode(
                array_unique(
                    array_filter(
                        preg_split("/\r\n|\n|\r/", $validatedData['ending_themes'])
                    )
                )
            );
        }

        if ($validatedData->has('cover')) {
            // The name of the image will be { Current_time.extension }
            // e.g. 1589633148.webp
            $cover = time().'.'.validatedData()->cover->getClientOriginalExtension();

            // Move the image to images directory to accessable from web
            validatedData()->cover->move(public_path('images'), $cover);

            // The path of the uploaded image
            $validatedData->cover = cdn('images/'.$cover);
        }

        return $validatedData->toArray();
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
