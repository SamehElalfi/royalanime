<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// the home page of the project
Route::get('/', 'WelcomeController@index');

Route::resources([
    'animes.episodes' => 'EpisodeController',   // All Episodes of an Anime
    'animes' => 'AnimeController',              // All Anime Details From MyAnimeList
    'tags' => 'TagController',                  // Anime List of One Tag (e.g. Action, Comedy ...)
    'blog/posts' => 'PostController',           // Posts in the Blog
    'pages' => 'PageController',                // Pages for every popular anime (e.g. Death Note, One Piece ...)
    'contact' => 'ContactController'            // Contact Page
]);

// /**
//  * Main Support Pages
//  * 
//  * need views
//  */
// Route::get('about', function(){return view('welcome');});
// Route::get('faq', function(){return view('welcome');});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
