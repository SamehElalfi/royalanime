<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// the home page of the project
Route::get('/', 'WelcomeController@index');
Route::get('/test', 'WelcomeController@test');

Route::get('/req', function () {
    $response = Http::asForm()->post('https://www.animesilver.com/watch/getQAServer', [
        'auth' => 'getQAServer',
        'ep' => 'الحلقة 06',
        'id' => '2242',
        'server' => 'Premieum',
        'c' => '1',
    ]);
    return $response;
});

    
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
Route::get('download_links', ['as'=>'animes.episodes.show', 'uses'=>'EpisodeController@download_links']);
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
    Route::get('settings',              ['as' => 'settings.index',              'uses' => 'SettingController@index']);
    Route::get('settings/animes',       ['as' => 'settings.animes',             'uses' => 'SettingController@animes']);
    Route::put('settings/animes',       ['as' => 'settings.animes.update',      'uses' => 'SettingController@update_animes']);

    Route::get('settings/episodes',     ['as' => 'settings.episodes',           'uses' => 'SettingController@episodes']);
    Route::put('settings/episodes',     ['as' => 'settings.episodes.update',    'uses' => 'SettingController@update_episodes']);

    Route::get('settings/blog',         ['as' => 'settings.blog',               'uses' => 'SettingController@blog']);
    Route::put('settings/blog',         ['as' => 'settings.blog.update',        'uses' => 'SettingController@update_blog']);

    Route::get('settings/comments',     ['as' => 'settings.comments',           'uses' => 'SettingController@comments']);
    Route::put('settings/comments',     ['as' => 'settings.comments.update',    'uses' => 'SettingController@update_comments']);

    Route::get('settings/frontend',     ['as' => 'settings.frontend',           'uses' => 'SettingController@frontend']);
    Route::put('settings/frontend',     ['as' => 'settings.frontend.update',    'uses' => 'SettingController@update_frontend']);

    Route::get('settings/social',       ['as' => 'settings.social',             'uses' => 'SettingController@social']);
    Route::put('settings/social',       ['as' => 'settings.social.update',      'uses' => 'SettingController@update_social']);

    Route::get('settings/backup',       ['as' => 'settings.backup',             'uses' => 'SettingController@backup']);
    Route::put('settings/backup',       ['as' => 'settings.backup.update',      'uses' => 'SettingController@update_backup']);

    Route::get('settings/users',        ['as' => 'settings.users',              'uses' => 'SettingController@users']);
    Route::put('settings/users',        ['as' => 'settings.users.update',       'uses' => 'SettingController@update_users']);

    Route::get('settings/advanced',     ['as' => 'settings.advanced',           'uses' => 'SettingController@advanced']);
    Route::put('settings/advanced',     ['as' => 'settings.advanced.update',    'uses' => 'SettingController@update_advanced']);

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
