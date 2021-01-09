<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use SoftDeletes;

    /**
     * Return all streaming links Watching (Streaming) of an episode
     */
    public function streamLinks()
    {
        return $this->hasOne('App\Models\StreamLink')->select(['links']);
    }

    /**
     * Return all streaming links (watching and downloading) of an episode
     */
    public function downloadLinks()
    {
        return $this->hasOne('App\Models\DownloadLink')->select(['links']);
    }

    /**
     * Return the anime episodes of an anime
     */
    public function anime()
    {
        return $this->belongsTo('App\Models\Anime');
    }
}
