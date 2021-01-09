<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class SearchController extends Controller
{

    /**
     * Display the search page
     *
     * @return \Illuminate\Http\Response
     */
    public function google_search()
    {
        $primary_nav = true;
        $title = 'البحث عن طريق جوجل';
        $description = 'أبحث عن أي حلقة أو مسلسل أو فيلم و بأي لغة تريد';
        return view('search.google', compact('primary_nav', 'title', 'description'));
    }


    /**
     * Display the search page
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $primary_nav = true;
        $title = 'البحث في الموقع';
        $description = 'أبحث عن أي حلقة أو مسلسل أو فيلم و بأي لغة تريد';

        $query = $request->input('q');
        if ($query) {
            $paginator = Anime::search($query, null, true)->paginate(10)->appends(['q' => $query]);
        } else {
            $paginator = [];
        }
        // return view('search', compact('primary_nav', 'title', 'description'));

        return view('search.index', compact('paginator', 'primary_nav', 'title', 'description', 'query'));
    }
}
