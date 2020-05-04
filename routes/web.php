<?php

use Illuminate\Support\Facades\Route;

// the home page of the project
Route::get('/', 'WelcomeController@index');

Route::middleware('page-cache')->get('/hi', 'LinkController@hi');
Route::get('/links/{id}', 'LinkController@index');
Route::post('/links/{anime}', 'LinkController@store');

Route::group(['middleware' => ['page-cache']], function () {
    
    Route::resources([
        'animes.episodes' => 'EpisodeController',   // All Episodes of an Anime. This route has another route for slug
    'animes' => 'AnimeController',              // All Anime Details From MyAnimeList. This route has another route for slug
    'tags' => 'TagController',                  // Anime List of One Tag (e.g. Action, Comedy ...)
    'status' => 'StatusController',             // Anime List of status (e.g. finished, airing ...)
    'blog/posts' => 'PostController',           // Posts in the Blog
    'pages' => 'PageController',                // Pages for every popular anime (e.g. Death Note, One Piece ...)
    'contact' => 'ContactController',           // Contact Page
    'mail' => 'MailController'                  // Subscript to newsletter Page
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

});

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
});

