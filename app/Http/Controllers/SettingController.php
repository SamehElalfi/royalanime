<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    /**
     * animes settings page
     */
    public function animes() {
        $title = __('dashboard.animes');
        return view('dashboard.settings.animes', compact('title'));
    }

    /**
     * Update all settings for animes
     */
    public function update_animes(Request $request) {
        return $request;
    }
    /**
     * episodes settings page
     */
    public function episodes() {
        $title = __('dashboard.episodes');
        return view('dashboard.settings.episodes', compact('title'));
    }

    /**
     * Update all settings for episodes
     */
    public function update_episodes(Request $request) {
        return $request;
    }
    /**
     * blog settings page
     */
    public function blog() {
        $title = __('dashboard.blog');
        return view('dashboard.settings.blog', compact('title'));
    }

    /**
     * Update all settings for blog
     */
    public function update_blog(Request $request) {
        return $request;
    }
    /**
     * comments settings page
     */
    public function comments() {
        $title = __('dashboard.comments');
        return view('dashboard.settings.comments', compact('title'));
    }

    /**
     * Update all settings for comments
     */
    public function update_comments(Request $request) {
        return $request;
    }
    /**
     * frontend settings page
     */
    public function frontend() {
        $title = __('dashboard.frontend');
        return view('dashboard.settings.frontend', compact('title'));
    }

    /**
     * Update all settings for frontend
     */
    public function update_frontend(Request $request) {
        return $request;
    }
    /**
     * social settings page
     */
    public function social() {
        $title = __('dashboard.social');
        return view('dashboard.settings.social', compact('title'));
    }

    /**
     * Update all settings for social
     */
    public function update_social(Request $request) {
        return $request;
    }
    /**
     * backup settings page
     */
    public function backup() {
        $title = __('dashboard.backup');
        return view('dashboard.settings.backup', compact('title'));
    }

    /**
     * Update all settings for backup
     */
    public function update_backup(Request $request) {
        return $request;
    }
    /**
     * users settings page
     */
    public function users() {
        $title = __('dashboard.users');
        return view('dashboard.settings.users', compact('title'));
    }

    /**
     * Update all settings for users
     */
    public function update_users(Request $request) {
        return $request;
    }
    /**
     * advanced settings page
     */
    public function advanced() {
        $title = __('dashboard.advanced');
        return view('dashboard.settings.advanced', compact('title'));
    }

    /**
     * Update all settings for advanced
     */
    public function update_advanced(Request $request) {
        $validatedData = $request->validate([
            'all-sitemaps' => 'nullable|in:on',
            'animes-sitemaps' => 'nullable|in:on',
            'episodes-sitemaps' => 'nullable|in:on',
            'pages-sitemaps' => 'nullable|in:on',
            'blog-sitemaps' => 'nullable|in:on',
            'main-sitemaps' => 'nullable|in:on',
        ]);
        // return $request;

        if (!empty($validatedData['all-sitemaps'])) {
            app('App\Http\Controllers\SitemapController')->all();
        } else {
            if (!empty($validatedData['animes-sitemaps'])) {
                $animes = app('App\Http\Controllers\SitemapController')->animes();
            }
            if (!empty($validatedData['episodes-sitemaps'])) {
                $episodes = app('App\Http\Controllers\SitemapController')->episodes();
            }
            if (!empty($validatedData['pages-sitemaps'])) {
                app('App\Http\Controllers\SitemapController')->pages();
            }
            if (!empty($validatedData['blog-sitemaps'])) {
                app('App\Http\Controllers\SitemapController')->blog();
            }
            if (!empty($validatedData['main-sitemaps'])) {
                app('App\Http\Controllers\SitemapController')->index();
            }
        }
        return back()->withStatus(__('dashboard.Settings Updated successfully'));;
    }
}
