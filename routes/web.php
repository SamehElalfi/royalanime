<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// the home page of the project
Route::get('/', 'WelcomeController@index')->name('homepage');
// Route::get('/roles', 'RoleController@index');
// Route::get('/test', 'WelcomeController@test');

// Route::get('/req', function () {
//     $response = Http::asForm()->post('https://www.animesilver.com/watch/getQAServer', [
//         'auth' => 'getQAServer',
//         'ep' => 'الحلقة 06',
//         'id' => '2242',
//         'server' => 'Premieum',
//         'c' => '1',
//     ]);
//     return $response;
// });
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth', 'can:add posts']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
    
Route::resources([
    'animes.episodes' => 'EpisodeController',   // All Episodes of an Anime. This route has another route for slug
    'animes' => 'AnimeController',              // All Anime Details From MyAnimeList. This route has another route for slug
    'tags' => 'TagController',                  // Anime List of One Tag (e.g. Action, Comedy ...)
    'studios' => 'StudioController',            // Anime Studios (e.g. ghibli, madhouse ...)
    'seasons' => 'SeasonController',            // Anime Seasons (e.g. 2019 summer ...)
    'rating' => 'RatingController',             // Anime Rating (e.g. PG - Children, G - All Ages ...)
    'types' => 'TypeController',             // Anime Rating (e.g. PG - Children, G - All Ages ...)
    'status' => 'StatusController',             // Anime List of status (e.g. finished, airing ...)
    'blog/posts' => 'PostController',           // Posts in the Blog
    'pages' => 'PageController',                // Pages for every popular anime (e.g. Death Note, One Piece ...)
    'contact' => 'ContactController',           // Contact Page
    'subscriber' => 'SubscriberController'      // Subscript to newsletter Page
]);

/**
 * all slugs for anime names and episodes
 */
Route::get('episodes', 'EpisodeController@episode_list')->name('episodes');   // All episodes for all animes
Route::get('animes/{anime}/{slug?}', ['as'=>'animes.show', 'uses'=>'AnimeController@show']);
Route::get('animes/{anime}/episodes/{episode}/{slug?}', ['as'=>'animes.episodes.show', 'uses'=>'EpisodeController@show']);
Route::get('tags/{tag}/{slug?}', ['as'=>'tags.show', 'uses'=>'TagController@show']);
Route::get('blog/posts/{post}/{slug?}', ['as'=>'posts.show', 'uses'=>'PostController@show']);

Route::get('embed/{url}', 'EmbedController@show')->where('url', '(.*)');
Route::get('embed', function(){return redirect('/');});


/**
 * Main Support Pages
 * 
 * need views
 */
Route::get('/{page}', 'PageController')->name('page')->where('page', 'about|terms');
Route::get('/search-google', 'SearchController@google_search')->name('google-search');
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/random', 'AnimeController@random')->name('random-anime');
Route::post('/blog', 'PostController@store');


/**
 * Login, Register and Dashboard routes
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/dashboard', 'WelcomeController@dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    // Settings Pages

    
    // Animes Management
    Route::get('settings',              ['as' => 'settings.index',              'uses' => 'SettingController@index']);
    Route::get('settings/animes/list',  ['as' => 'settings.animes.list',        'uses' => 'SettingController@animes_list']);
    Route::get('settings/animes',       ['as' => 'settings.animes',             'uses' => 'SettingController@animes']);
    Route::put('settings/animes',       ['as' => 'settings.animes.update',      'uses' => 'SettingController@update_animes']);
    
    // Episodes Management
    Route::get('settings/episodes/create',['as' => 'settings.episodes.create',   'uses' => 'SettingController@create_episode']);
    Route::get('settings/episodes/list',['as' => 'settings.episodes.list',       'uses' => 'SettingController@episodes_list']);
    Route::get('settings/episodes',     ['as' => 'settings.episodes',            'uses' => 'SettingController@episodes']);
    Route::put('settings/episodes',     ['as' => 'settings.episodes.update',     'uses' => 'SettingController@update_episodes']);
    
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
    
    // Blog Posts Management
    Route::get('settings/posts/list',  ['as' => 'settings.posts.list',        'uses' => 'PostController@posts_list']);
});
