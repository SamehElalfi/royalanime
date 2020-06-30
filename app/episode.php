<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use SoftDeletes;

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
    public function anime() {
        return $this->belongsTo('App\Anime');
    }
}
