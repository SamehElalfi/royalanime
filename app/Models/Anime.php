<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Anime extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $guarded = [];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'animes.title_english' => 100,
            'animes.title' => 10,
            // 'animes.arabic_synopsis' => 5,
            'animes.title_synonyms' => 5,
            // 'animes.title_japanese' => 2,
        ],
    ];

    /**
     * Return the anime episodes of an anime
     */
    public function episodesList()
    {
        return $this->hasMany('App\Models\Episode');
    }
}
