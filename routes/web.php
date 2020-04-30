<?php

use Illuminate\Support\Facades\Route;

// the home page of the project
Route::get('/', 'WelcomeController@index');

Route::get('/links/{id}', 'LinkController@index');
Route::post('/links/{anime}', 'LinkController@store');
Route::get('/dashboard', 'WelcomeController@dashboard');

Route::resources([
    'animes.episodes' => 'EpisodeController',   // All Episodes of an Anime
    'animes' => 'AnimeController',              // All Anime Details From MyAnimeList
    'tags' => 'TagController',                  // Anime List of One Tag (e.g. Action, Comedy ...)
    'status' => 'StatusController',             // Anime List of status (e.g. finished, airing ...)
    'blog/posts' => 'PostController',           // Posts in the Blog
    'pages' => 'PageController',                // Pages for every popular anime (e.g. Death Note, One Piece ...)
    'contact' => 'ContactController',           // Contact Page
    'mail' => 'MailController'                  // Subscript to newsletter Page
    ]);
    
// /**
//  * Main Support Pages
//  * 
//  * need views
//  */
Route::get('/search', 'WelcomeController@search');
// Route::get('about', function(){return view('welcome');});
// Route::get('faq', function(){return view('welcome');});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
