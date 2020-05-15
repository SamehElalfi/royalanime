<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpisodeDetail extends Model
{
    /**
     * Return the name of the table for this model
     */
    public function getTableName() {
        return $this->getTable();
    }

    /**
     * Return the anime episodes of an anime
     */
    public function animeEpisodes() {
        return $this->hasMany('App\Episode', 'anime_id', 'mal_id');
    }

    /**
     * Return the anime episodes of an anime
     */
    public function animeDetails() {
        return $this->hasOne('App\Anime', 'id', 'mal_id');
    }
}
