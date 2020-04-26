<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class episode extends Model
{
    /**
     * Return all links (watching and downloading) of an episode
     */
    public function link() {
        return $this->hasMany('App\Link', 'episode_id', 'episode_id');
    }

    /**
     * Return the anime episodes of an anime
     */
    public function animeEpisodes() {
        return $this->hasMany('App\Episode', 'mal_id', 'mal_id');
    }
}
