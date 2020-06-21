<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    // Remove created_at and updated_at from this model
    public $timestamps = false;

    /**
     * Return all streaimg links Watching (Streaming) of an episode
     */
    public function watchLinks() {
        return $this->hasOne('App\StreamLink')->select(['links']);
    }

    /**
     * Return all streaimg links (watching and downloading) of an episode
     */
    public function downloadLinks() {
        return $this->hasOne('App\DownloadLink')->select(['links']);
    }

    /**
     * Return the anime episodes of an anime
     */
    public function animeEpisodes() {
        return $this->hasMany('App\Episode', 'anime_id', 'anime_id');
    }
    /**
     * Return the anime episodes of an anime
     */
    public function episodeDetails() {
        return $this->hasOne('App\EpisodeDetail');
    }
}
