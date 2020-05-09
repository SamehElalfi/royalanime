<?php

use Illuminate\Support\Facades\Route;

// the home page of the project
Route::middleware('page-cache')->get('/', 'WelcomeController@index');

// Route::get('/links/{id}', 'LinkController@index');
// Route::post('/links/{anime}', 'LinkController@store');

Route::domain('www.royalanime.com')->group(function () {
    Route::get('domain-test/{id}', function ($id) {
        return $id . ' from www';
    });
});
Route::domain('cdn.royalanime.com')->group(function () {
    Route::get('domain-test/{id}', function ($id) {
        return $id . 'from cdn';
    });
});
// Route::get('/req', function () {
//     $response = Http::asForm()->post('https://www.animesilver.com/watch/getQAServer', [
//         'auth' => 'Premieum',
//         'ep' => 'الحلقة 05',
//         'id' => '2255',
//         'server' => 'Oserver',
//         'c' => '1',
//     ]);
//     return $response;
// });
    
Route::resources([
    'animes.episodes' => 'EpisodeController',   // All Episodes of an Anime. This route has another route for slug
    'animes' => 'AnimeController',              // All Anime Details From MyAnimeList. This route has another route for slug
    'tags' => 'TagController',                  // Anime List of One Tag (e.g. Action, Comedy ...)
    'status' => 'StatusController',             // Anime List of status (e.g. finished, airing ...)
    'blog/posts' => 'PostController',           // Posts in the Blog
    'pages' => 'PageController',                // Pages for every popular anime (e.g. Death Note, One Piece ...)
    'contact' => 'ContactController',           // Contact Page
    'subscriber' => 'SubscriberController'      // Subscript to newsletter Page
]);

/**
 * all slugs for anime names and episodes
 */
Route::get('animes/{anime}/{slug?}', ['as'=>'animes.show', 'uses'=>'AnimeController@show']);
Route::get('animes/{anime}/episodes/{episode}/{slug?}', ['as'=>'animes.episodes.show', 'uses'=>'EpisodeController@show']);
Route::get('tags/{tag}/{slug?}', ['as'=>'tags.show', 'uses'=>'TagController@show']);
Route::get('blog/posts/{post}/{slug?}', ['as'=>'posts.show', 'uses'=>'PostController@show']);
    
    
// /**
//  * Main Support Pages
//  * 
//  * need views
//  */
Route::get('/search', 'WelcomeController@search');
// Route::get('about', function(){return view('welcome');});
// Route::get('faq', function(){return view('welcome');});


/**
 * Login, Register and Dashboard routes
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'WelcomeController@dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    // Settings Pages
    Route::get('settings',              ['as' => 'settings.index',      'uses' => 'SettingController@index']);
    Route::get('settings/animes',       ['as' => 'settings.animes',     'uses' => 'SettingController@animes']);
    Route::get('settings/episodes',     ['as' => 'settings.episodes',   'uses' => 'SettingController@episodes']);
    Route::get('settings/blog',         ['as' => 'settings.blog',       'uses' => 'SettingController@blog']);
    Route::get('settings/comments',     ['as' => 'settings.comments',   'uses' => 'SettingController@comments']);
    Route::get('settings/frontend',     ['as' => 'settings.frontend',   'uses' => 'SettingController@frontend']);
    Route::get('settings/social',       ['as' => 'settings.social',     'uses' => 'SettingController@social']);
    Route::get('settings/backup',       ['as' => 'settings.backup',     'uses' => 'SettingController@backup']);
    Route::get('settings/users',        ['as' => 'settings.users',      'uses' => 'SettingController@users']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
