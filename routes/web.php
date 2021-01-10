<?php

use Illuminate\Support\Facades\Route;

// the home page of the project
Route::get('/', 'IndexController@index')->name('homepage');

Route::resources([
    'animes.episodes' => 'EpisodeController',   // All Episodes of an Anime. This route has another route for slug
    'animes' => 'AnimeController',              // All Anime Details From MyAnimeList. This route has another route for slug
    'tags' => 'TagController',                  // Anime List of One Tag (e.g. Action, Comedy ...)
    'studios' => 'StudioController',            // Anime Studios (e.g. ghibli, madhouse ...)
    'seasons' => 'SeasonController',            // Anime Seasons (e.g. 2019 summer ...)
    'rating' => 'RatingController',             // Anime Rating (e.g. PG - Children, G - All Ages ...)
    'types' => 'TypeController',                // Anime Rating (e.g. PG - Children, G - All Ages ...)
    'status' => 'StatusController',             // Anime List of status (e.g. finished, airing ...)
    'blog/posts' => 'PostController',           // Posts in the Blog
    'pages' => 'PageController',                // Pages for every popular anime (e.g. Death Note, One Piece ...)
    'subscriber' => 'SubscriberController'      // Subscript to newsletter Page
]);

// Contact Page
Route::resource('contact', 'ContactController')->except(['edit', 'update']);

/**
 * all slugs for anime names and episodes
 */
Route::get('episodes', 'EpisodeController@list')->name('animes.episodes.list');   // All episodes for all animes
Route::get('animes/{anime}/{slug?}', ['as' => 'animes.show.slug', 'uses' => 'AnimeController@show']);
Route::get('animes/{anime}/episodes/{episode}/{slug?}', ['as' => 'animes.episodes.show.slug', 'uses' => 'EpisodeController@show']);
Route::get('tags/{tag}/{slug?}', ['as' => 'tags.show.slug', 'uses' => 'TagController@show']);
Route::get('blog/posts/{post}/{slug?}', ['as' => 'posts.show.slug', 'uses' => 'PostController@show']);

Route::get('royalembed/{url}', 'EmbedController@show')->where('url', '(.*)');
// Route::get('royalembed', function () {
//     return redirect('/');
// });


/**
 * Main Support Pages
 *
 * need views
 */
Route::get('/{page}', 'PageController')->name('page')->where('page', 'about|terms');
Route::get('/search-google', 'SearchController@google_search')->name('google-search');
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/random', 'AnimeController@random')->name('random-anime');
Route::get('/blog', 'PostController@index');
Route::post('/blog', 'PostController@store');
