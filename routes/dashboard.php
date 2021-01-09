<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Login, Register and Dashboard routes
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/dashboard', 'IndexController@dashboard');


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
    Route::get('settings/episodes/create', ['as' => 'settings.episodes.create',   'uses' => 'SettingController@create_episode']);
    Route::get('settings/episodes/list', ['as' => 'settings.episodes.list',       'uses' => 'SettingController@episodes_list']);
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
