<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Anime;
use App\Episode;
use Str;
use URL;
use Carbon\Carbon;
use File;


class SitemapController extends Controller
{
    /**
     * Generate the main sitemap index /sitemap.xml
     */
    public function index() {
        $sitemap = App::make('sitemap');
        
        // Get all sitemaps from sitemap dir
        $path = public_path('sitemap');
        $files = File::allfiles($path);

        foreach ($files as $file) {
            if ($file->getExtension() == 'xml') {
                // Add the file to the main sitemap
                $sitemap->addSitemap(secure_url('sitemap/'.$file->getFileName()));
            }
        }

        // Save the final sitemap index
        $sitemap->store('sitemapindex', 'sitemap');
    }

    /**
     * Generate sitemap for episodes
     * The generated sitemap saved in /sitemap/ directory
     */
    public function episodes()
    {
        $sitemap = App::make('sitemap');
        $episodes = Episode::get();

        // counters
        $counter = 0;
        $sitemapCounter = 1;

        // add every product to multiple sitemaps with one sitemap index
        foreach ($episodes as $p) {
            // the number of links saved in evert sitemap
            if ($counter == 1000) {
                // generate new sitemap file
                $sitemap->store('xml', 'sitemap/sitemap-episodes-' . $sitemapCounter);
                // add the file to the sitemaps array
                $sitemap->addSitemap(secure_url('sitemap/sitemap-episodes-' . $sitemapCounter . '.xml'));
                // reset items array (clear memory)
                $sitemap->model->resetItems();
                // reset the counter
                $counter = 0;
                // count generated sitemap
                $sitemapCounter++;
            }
            $url = route('animes.episodes.show', ['anime'=>$p->anime_id, 'episode'=>$p->episode_number]);
            $sitemap->add($url, Carbon::now()->toAtomString(), '0.8', 'weekly');
            $counter++;
        }

        // you need to check for unused items
        if (!empty($sitemap->model->getItems())) {
            // generate sitemap with last items
            $sitemap->store('xml', 'sitemap/sitemap-episodes-' . $sitemapCounter);
            // add sitemap to sitemaps array
            $sitemap->addSitemap(secure_url('sitemap/sitemap-episodes-' . $sitemapCounter . '.xml'));
            // reset items array
            $sitemap->model->resetItems();
        }

    }

    /**
     * Generate sitemap for animes
     * The generated sitemap saved in /sitemap/ directory
     */
    public function animes() {
        // create sitemap for animes
        $sitemap = App::make("sitemap");
        $animes = Anime::chunk(10000, function ($animes) use ($sitemap) {
            foreach ($animes as $anime)
            {
                $url = route('animes.show', ['anime'=>$anime->id.'/'.Str::slug($anime->title)]);
                $sitemap->add($url, $anime->updated_at, '9.0', 'weekly');
            }
        });
        $sitemap->store('xml','sitemap/sitemap-animes');
    }



    /**
     * Generate sitemap for pages
     * The generated sitemap saved in /sitemap/ directory
     */
    public function pages() {
        // 
    }

    /**
     * Generate sitemap for animes
     * The generated sitemap saved in /sitemap/ directory
     */
    public function posts() {
        // 
    }

    /**
     * Generate sitemap for all other sitemaps
     * in sitemap directory
     * 
     * The generated sitemap saved in /public directory
     */
    public function all() {
        $this->animes();
        $this->episodes();
        $this->pages();
        $this->pages();
        $this->index();
    }
}
