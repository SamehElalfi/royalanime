<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "arabic_synopsis" => "nullable",
            "anime_type" => "in:TV,Movie,OVA,ONA,Special,Music",
            "aired_from" => "nullable|date",
            "aired_to" => "nullable|date",
            "background" => "nullable",
            "broadcast" => "nullable",
            "cover" => "image|mimes:jpeg,png,jpg,gif,svg",
            "duration" => "nullable",
            "ending_themes" => "nullable",
            "episodes" => "nullable",
            "favorites" => "nullable",
            "genres" => "nullable",
            "image_url" => "nullable",
            "mal_id" => "numeric",
            "members" => "nullable",
            "name" => "required",
            "opening_themes" => "nullable",
            "popularity" => "nullable",
            "rank" => "nullable",
            "rating" => "numeric|between:0,5",
            "source" => "numeric|between:0,15",
            "status" => "in:airing,finished,upcoming",
            "scored_by" => "nullable",
            "synopsis" => "nullable",
            "title_english" => "nullable",
            "title_japanese" => "nullable",
            "title_synonyms" => "nullable",
            "trailer_url" => "nullable",
            "url" => "nullable"
        ];
    }
}
