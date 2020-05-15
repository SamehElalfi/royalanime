@extends('dashboard.layouts.app', ['title' => __('dashboard.Add Anime')])

@section('content')
@include('dashboard.users.partials.header', [
    'title' => __('dashboard.Add a new anime to anime list'),
    'description' => __('dashboard.Fill this form to create an anime, please note that any empty field willbe shown as unknown.'),
])   

<div class="container-fluid mt--7">
    <form method="post" action="{{ route('animes.store') }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- Form Section --}}
            <div class="col-xl-8">
                <div class="card bg-secondary shadow">
                    
                    @if (\Session::has('main'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ \Session::get('main') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('dashboard.Add New Anime') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('dashboard.Anime Details') }}</h6>
                        <div class="pl-lg-4">

                            {{-- Anime Title --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">{{ __('dashboard.Name') }} <span class="text-muted">({{ __('dashboard.Mandatory') }})</span></label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('name') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Fullmetal Alchemist: Brotherhood"  autofocus value="{{ old('name') }}">
                            </div>

                            {{-- My Anime List ID --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-mal_id">{{ __('dashboard.My Anime List id') }} <span class="text-muted">({{ __('dashboard.Mandatory') }})</span></label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('mal_id'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('mal_id') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <div class="row container">
                                    <input type="number" name="mal_id" id="input-mal_id" class="form-control col-12 col-md-8{{ $errors->has('mal_id') ? ' is-invalid' : '' }}" placeholder="5114" min="1" value="{{ old('mal_id') }}">
                                    
                                    {{-- When clickinng on this <span> we will scrape all anime details from Jikan API --}}
                                    {{-- After that all form's inputs, Textareas and select options will be changed to the scraped data --}}
                                    {{-- and the Anime Preview Card will be changed too --}}
                                    <span class="btn btn-default my-2 mt-md-0 ml-md-4 mr-md-2 col col-12 col-md-3" onclick="scrape_mal_data();">{{ __('dashboard.Scrape MAL Data') }}</span>
                                </div>
                            </div>

                            {{-- Arabic Story for the anime --}}
                            {{-- this textarea contains the story which will be shown in the website --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-arabic_synopsis">{{ __('dashboard.Arabic Story') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('arabic_synopsis'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('arabic_synopsis') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <textarea id="input-arabic_synopsis" name="arabic_synopsis" autocomplete="false" class="form-control{{ $errors->has('mal_id') ? ' is-invalid' : '' }}" rows="4" placeholder="عندما أيفقد الأخوان “ألفونس” و “أدوارد” أمهما إثر مرض عضال.. عندها يقومان بإستخدام قوة الخيمياء المحرمة لإرجاع روح أمهما.">{{ old('arabic_synopsis') }}</textarea>
                            </div>

                            {{-- The count of Episode for this anime --}}
                            {{-- This value could be zero or higher --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-episodes">{{ __('dashboard.Number of episodes') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('episodes'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('episodes') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="number" name="episodes" id="input-episodes" class="form-control{{ $errors->has('episodes') ? ' border-danger' : '' }}" value="{{ old('episodes') ?? '12' }}" min="0">
                            </div>

                            {{-- The Anime Genres (Tags e.g. Action, Magic .. etc) --}}
                            {{-- All tags are splitted with commas (,) and stored in another two places --}}
                            {{-- 1- the hidden input called 'genres' as a text => "Action, Adventure,"--}}
                            {{-- 2- the suggestions div tag as children divs --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-genres">{{ __('dashboard.Genres') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('genres'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('genres') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {{-- The tags will be automaticlly stored when user press Enter or comma (,) --}}
                                <input type="text" id="input-genres" class="form-control{{ $errors->has('genres') ? ' is-invalid' : '' }}" placeholder="أكشن, مغامرات">

                                {{-- here the actual tags are stored --}}
                                {{-- all tags are translated into Arabic on the server side (AnimeController@store) --}}
                                <input type="hidden" name="genres" id="tags-container" value="{{ old('genres') }}">

                                {{-- When the user trying to write a new tag, the next box will be displayed--}}
                                {{-- and this box contains all suggesstions for the tag --}}
                                {{-- So, the user doesn't need to write the full text of the tag --}}
                                <div id="suggestions" class="bg-white border border-top-0 position-absolute">
                                    @foreach ($tags as $tag)
                                        <p class="py-2 px-6 mb-0" style="display:none;cursor: pointer;">{{ $tag }}</p>
                                    @endforeach
                                </div>

                                <span class="text-muted h5 my-1">  * {{ __('dashboard.Separate genres with commas') }}</span>

                                {{-- When the user add a new tag, it will be showen in this div as child --}}
                                {{-- and all inserted tags has the option to be removed by clicking on close icon --}}
                                <div id="tags" class="row"></div>
                            </div>

                            <hr class="my-6" />
                            
                            {{-- The other names for the anime --}}
                            {{-- English Title --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-title_english">{{ __('dashboard.English Title') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('title_english'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('title_english') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" name="title_english" id="input-title_english" class="form-control{{ $errors->has('title_english') ? ' is-invalid' : '' }}" placeholder="Fullmetal Alchemist: Brotherhood" value="{{ old('title_english') }}">
                            </div>

                            {{-- Japanese Title --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-title_japanese">{{ __('dashboard.Japanese Title') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('title_japanese'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('title_japanese') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" name="title_japanese" id="input-title_japanese" class="form-control{{ $errors->has('title_japanese') ? ' is-invalid' : '' }}" placeholder="鋼の錬金術師 FULLMETAL ALCHEMIST" value="{{ old('title_japanese') }}">
                            </div>
                            
                            {{-- Title Synonyms --}}
                            {{-- All synonyms are splitted with comma (,) and processes on the server side --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-title_synonyms">{{ __('dashboard.Synonyms') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('title_synonyms'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('title_synonyms') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" name="title_synonyms" id="input-title_synonyms" class="form-control{{ $errors->has('title_synonyms') ? ' is-invalid' : '' }}" placeholder="Fullmetal Alchemist (2009), FMA, FMAB" value="{{ old('title_synonyms') }}">
                                <span class="text-muted h5 float-right">  * {{ __('dashboard.Separate synonyms with commas') }}</span>
                            </div>
                            
                            <hr class="my-6" />
                            
                            {{-- The Type of the Anime --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-anime_type">{{ __('dashboard.Anime Type') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('anime_type'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('anime_type') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <select id="input-anime_type" name="anime_type" class="form-control{{ $errors->has('anime_type') ? ' border-danger' : '' }}">
                                    <option {{ old('anime_type') == 'TV' ? 'selected' : '' }}value="TV">مسلسل</option>
                                    <option {{ old('anime_type') == 'Movie' ? 'selected' : '' }}value="Movie">فيلم</option>
                                    <option {{ old('anime_type') == 'OVA' ? 'selected' : '' }}value="OVA">أوفا</option>
                                    <option {{ old('anime_type') == 'ONA' ? 'selected' : '' }}value="ONA">أونا</option>
                                    <option {{ old('anime_type') == 'Special' ? 'selected' : '' }}value="Special">خاصة</option>
                                    <option {{ old('anime_type') == 'Music' ? 'selected' : '' }}value="Music">موسيقى</option>
                                </select>
                            </div>

                            {{-- From where the anime was borrowed --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-source">{{ __('dashboard.Anime Source') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('source'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('source') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <select id="input-source" name="source" class="form-control{{ $errors->has('source') ? ' border-danger' : '' }}">
                                    <option {{ old('source') == '0' ? 'selected' : '' }} id="Manga" value="0">Manga</option>
                                    <option {{ old('source') == '1' ? 'selected' : '' }} id="Original" value="1">Original</option>
                                    <option {{ old('source') == '2' ? 'selected' : '' }} id="Light-novel" value="2">Light novel</option>
                                    <option {{ old('source') == '3' ? 'selected' : '' }} id="Game" value="3">Game</option>
                                    <option {{ old('source') == '4' ? 'selected' : '' }} id="Visual-novel" value="4">Visual novel</option>
                                    <option {{ old('source') == '5' ? 'selected' : '' }} id="Novel" value="5">Novel</option>
                                    <option {{ old('source') == '6' ? 'selected' : '' }} id="4-koma-manga" value="6">4-koma manga</option>
                                    <option {{ old('source') == '7' ? 'selected' : '' }} id="Web-manga" value="7">Web manga</option>
                                    <option {{ old('source') == '8' ? 'selected' : '' }} id="Unknown" value="8">Unknown</option>
                                    <option {{ old('source') == '9' ? 'selected' : '' }} id="Other" value="9">Other</option>
                                    <option {{ old('source') == '10' ? 'selected' : '' }} id="Card-game" value="10">Card game</option>
                                    <option {{ old('source') == '11' ? 'selected' : '' }} id="Music" value="11">Music</option>
                                    <option {{ old('source') == '12' ? 'selected' : '' }} id="Book" value="12">Book</option>
                                    <option {{ old('source') == '13' ? 'selected' : '' }} id="Digital-manga" value="13">Digital manga</option>
                                    <option {{ old('source') == '14' ? 'selected' : '' }} id="Picture-book" value="14">Picture book</option>
                                    <option {{ old('source') == '15' ? 'selected' : '' }} id="Radio" value="15">Radio</option>
                                </select>
                            </div>
                            
                            {{-- The Status of The Anime (finished, upcoming ... etc) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="status">{{ __('dashboard.Anime Status') }}</label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('status'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {{-- Status: airing --}}
                                <div class="custom-control custom-radio mb-3">
                                    <input name="status" class="custom-control-input{{ $errors->has('status') ? ' is-invalid' : '' }}" id="customRadio1 currently" checked="" type="radio" value="currently" {{ old('status') == 'currently' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadio1">
                                        <span>{{ __('dashboard.Airing') }}</span>
                                    </label>
                                </div>

                                {{-- Status: finished --}}
                                <div class="custom-control custom-radio mb-3">
                                    <input name="status" class="custom-control-input{{ $errors->has('status') ? ' is-invalid' : '' }}" id="customRadio2 finished" type="radio" value="finished" {{ old('status') == 'finished' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadio2">
                                        <span>{{ __('dashboard.Finished') }}</span>
                                    </label>
                                </div>

                                {{-- Status: upcoming --}}
                                <div class="custom-control custom-radio mb-3">
                                    <input name="status" class="custom-control-input{{ $errors->has('status') ? ' is-invalid' : '' }}" id="customRadio3 upcoming" type="radio" value="upcoming" {{ old('status') == 'upcoming' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customRadio3">
                                        <span>{{ __('dashboard.Upcoming') }}</span>
                                    </label>
                                </div>
                            </div>

                            {{-- The dates of this anime (Aired From & Aired To) --}}
                            <div class="row">
                                {{-- Aired From --}}
                                <div class="form-group col col-12 col-md-6">
                                    <label class="form-control-label d-block" for="input-aired_from">{{ __('dashboard.Aired From') }}</label>
                                    
                                    {{-- Display an error message here --}}
                                    @if ($errors->has('aired_from'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('aired_from') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <input type="date" id="aired_from" name="aired_from" class="rounded p-3{{ $errors->has('aired_from') ? ' border-danger' : ' border' }}" value="{{ old('aired_from') }}">
                                </div>

                                {{-- Aired To --}}
                                <div class="form-group col col-12 col-md-6">
                                    <label class="form-control-label d-block" for="input-aired_to">{{ __('dashboard.Aired To') }}</label>
                                    
                                    {{-- Display an error message here --}}
                                    @if ($errors->has('aired_to'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('aired_to') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    
                                    <input type="date" id="aired_to" name="aired_to" class="rounded p-3{{ $errors->has('aired_to') ? ' border-danger' : ' border' }}" value="{{ old('aired_to') }}">
                                </div>
                            </div>

                            {{-- The average duration of every Episode --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-duration">{{ __('dashboard.Average Episode Duration') }} <span class="text-muted">({{ __('dashboard.With Minutes') }})</span></label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('duration'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('duration') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" dir="ltr" name="duration" id="input-duration" class="form-control{{ $errors->has('duration') ? ' has-danger' : '' }}" value="{{ old('duration') }}">
                            </div>

                            {{-- The Rating of this Anime (for teen, children ... etc) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-rating">{{ __('dashboard.Anime Rating') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('rating'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('rating') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <select id="input-rating" name="rating" class="form-control{{ $errors->has('rating') ? ' border-danger' : '' }}">
                                    <option {{ old('rating') == '3' ? 'selected' : '' }} id="PG-13 - Teens 13 or older" value="3">{{ __('dashboard.PG-13 - Teens 13 or older') }}</option>
                                    <option {{ old('rating') == '4' ? 'selected' : '' }} id="R - 17+ (violence & profanity)" value="4">{{ __('dashboard.R - 17+ (violence & profanity)') }}</option>
                                    <option {{ old('rating') == '1' ? 'selected' : '' }} id="G - All Ages" value="1">{{ __('dashboard.G - All Ages') }}</option>
                                    <option {{ old('rating') == '5' ? 'selected' : '' }} id="R+ - Mild Nudity" value="5">{{ __('dashboard.R+ - Mild Nudity') }}</option>
                                    <option {{ old('rating') == '2' ? 'selected' : '' }} id="PG - Children" value="2">{{ __('dashboard.PG - Children') }}</option>
                                    <option {{ old('rating') == '0' ? 'selected' : '' }} id="None" value="0">{{ __('dashboard.None') }}</option>
                                </select>
                            </div>

                            {{-- The Score of the anime in My Anime List --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-score">{{ __('dashboard.Anime Score') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('score'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('score') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                                <input type="number" name="score" id="input-score" class="form-control{{ $errors->has('score') ? ' has-danger' : '' }}" value="{{ old('score') ?? '8.9'}}" step=".01" max="10" min="0">
                            </div>
                            
                            <hr class="my-6" />

                            {{-- The backgound of the story in English --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-background">{{ __('dashboard.Anime Background') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('background'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('background') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <textarea id="input-background" name="background" autocomplete="false" class="form-control{{ $errors->has('background') ? ' is-invalid' : '' }}" rows="4" placeholder="Fullmetal Alchemist: Brotherhood is an alternate retelling of Hiromu Arakawa's Fullmetal Alchemist manga that is closer to the source material than the previous 2003 adaptation, this time covering the entire story.">{{ old('background') }}</textarea>
                            </div>
                            
                            {{-- The summary of the story --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-synopsis">{{ __('dashboard.Anime Synopsis') }} <span class="text-muted">({{ __('dashboard.in English') }})</span></label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('synopsis'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('synopsis') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <textarea id="input-synopsis" name="synopsis" autocomplete="false" class="form-control{{ $errors->has('synopsis') ? ' is-invalid' : '' }}" rows="4" placeholder="In order for something to be obtained, something of equal value must be lost." dir="ltr">{{ old('synopsis') }}</textarea>
                            </div>

                            {{-- The days for the Broadcast --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-broadcast">{{ __('dashboard.Broadcast') }}</label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('broadcast'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('broadcast') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" dir="ltr" name="broadcast" id="input-broadcast" class="form-control{{ $errors->has('broadcast') ? ' has-danger' : '' }}" value="{{ old('broadcast') }}">
                            </div>

                            {{-- Themes (Intro & Outtro) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-opening_themes">{{ __('dashboard.Opening Themes') }} <span class="text-muted">({{ __('dashboard.Every line is a new theme') }})</span></label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('opening_themes'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('opening_themes') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <textarea id="input-opening_themes" name="opening_themes" autocomplete="false" class="form-control{{ $errors->has('opening_themes') ? ' is-invalid' : '' }}" rows="4" placeholder='"again" by YUI (eps 1-14)' dir="ltr">{{ old('opening_themes') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-ending_themes">{{ __('dashboard.Ending Themes') }} <span class="text-muted">({{ __('dashboard.Every line is a new theme') }})</span></label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('ending_themes'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('ending_themes') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <textarea id="input-ending_themes" name="ending_themes" autocomplete="false" class="form-control{{ $errors->has('ending_themes') ? ' is-invalid' : '' }}" rows="4" placeholder='"Uso (嘘)" by SID (eps 1-14)' dir="ltr">{{ old('ending_themes') }}</textarea>
                            </div>

                            <input type="hidden" value="" name="favorites">
                            <input type="hidden" value="" name="image_url">
                            <input type="hidden" value="" name="members">
                            <input type="hidden" value="" name="popularity">
                            <input type="hidden" value="" name="rank">
                            <input type="hidden" value="" name="scored_by">
                            <input type="hidden" value="" name="trailer_url">
                            <input type="hidden" value="" name="url">

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('dashboard.Add Anime') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Anime Card --}}
            <div class="col-xl-4 mt-5 mt-xl-0">
                <div class="card card-profile shadow border-0 rounded overflow-hidden my-5">
                    
                    {{-- This fiekd is where the anime cover is stored --}}
                    <input id="file-input" type="file" name="cover" class="d-none" />
                    
                    {{-- Display an error message here --}}
                    @if ($errors->has('cover'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first('cover') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4" style="background: linear-gradient(rgba(94, 114, 228, 0.25), rgba(23, 43, 77, 0.66)), url(https://animesilver.com/assets/Uploads/wallpaper/310.jpg);background-position: center;min-height: 200px;background-size: cover;" onclick="document.getElementById('file-input').click();" id="coverImg">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4" id="preview-season">ربيع 2009</a>
                            <a href="#" class="btn btn-sm btn-default float-right" id="preview-status">منتهي</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 mt--5">
                        <h3 class="text-center text-white" id="preview-title">
                            Fullmetal Alchemist: Brotherhood
                        </h3>
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading" id="preview-episodes">64</span>
                                        <span class="description">حلقة</span>
                                    </div>
                                    <div>
                                        <span class="heading" id="preview-rating">R - 17+</span>
                                        <span class="description">التصنيف</span>
                                    </div>
                                    <div>
                                        <span class="heading" id="preview-score">8.9</span>
                                        <span class="description">تقييم</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="h5 font-weight-300" id="preview-tags">
                                أكشن، سحر، عسكري
                            </div>
                            
                            <hr class="my-4">

                            <p id="preview-story"> عندما أيفقد الأخوان “ألفونس” و “أدوارد” أمهما إثر مرض عضال.. عندها يقومان بإستخدام قوة الخيمياء المحرمة لإرجاع روح أمهما.</p>
                            <a href="#">مشاهدة المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="card card-profile shadow border-0 rounded overflow-hidden">
                    <img id="anime-image" src="" class="w-100">
                </div>
            </div>
        </div>
    </form>
    
    @push('js')
        <script>
            /**
            * Make Get Request to jikan.moe API to scrape myanimelist.net data
            * Jikan is unofficial MAL api
            * 
            * This function get the value from mal_id input
            * after that it calls update_fields() to remove the old values
            * from the form's inputs and insert the new values from MAL
            * 
            * @returns None
            */
            function scrape_mal_data() {
                // Getting My Anime List ID for the anime
                mal_id = $('#input-mal_id').val()

                // Make a Get Request to jikan api
                response = $.get('https://api.jikan.moe/v3/anime/'+mal_id, function(data, status) {
                    if (status == 'success') {
                        // update_fields() takes one @argument data
                        // data argument is a valid JSON Response from jikan api
                        // contains all anime data
                        update_fields(response.responseJSON);
                        console.log(response.responseJSON);
                    }
                });
            }

            /**
            * Update all form's inputs, textareas .. etc with the new scraped data
            * from Jikan API
            * 
            * This function is called by default from scrape_mal_data() funcction
            * 
            * @argument data: Valid JSON Code from jikan API V3
            * 
            * @returns None
            */
            function update_fields(data) {
                // Official Anime Title in English, Japanese and other Synonyms
                $('#input-name').val(data['title']);
                $('#input-title_english').val(data['title_english']);
                $('#input-title_japanese').val(data['title_japanese']);
                $('#input-title_synonyms').val(data['title_synonyms']);

                // The Count of Episodes
                $('#input-episodes').val(data['episodes']);

                // Anime Airing dates (from and to)
                // the value may be 'null' for some animes
                if (data['aired']['from'] != null) {
                    $('#aired_from').val(data['aired']['from'].slice(0,10));
                }
                if (data['aired']['to'] != null) {
                    $('#aired_to').val(data['aired']['to'].slice(0,10));
                }

                // Anime Score Value e.g. 8.97
                $('#input-score').val(data['score']);

                // All Paragraphs from MAL like the synopsis and background of the story
                // these values stored in textareas not inputs
                $('#input-background').val(data['background']);
                $('#input-synopsis').val(data['synopsis']);
                
                // The average duration for every episode
                $('#input-duration').val(data['duration']);
                
                // Anime intros (Opening Themes) and outros (Ending Themes)
                // the API returns these themes as an array
                // So, We should join them to add them in textareas
                // Every theme takes one line
                data['opening_themes'].forEach(theme => {
                    $('#input-opening_themes').val($('#input-opening_themes').val()+theme+'\r\n');
                });
                data['ending_themes'].forEach(theme => {
                    $('#input-ending_themes').val($('#input-ending_themes').val()+theme+'\r\n');
                });

                // Anime Status [Currently Airing, Finished Airing, Upcoming]
                $("input[name='status']").each(function () {$(this).removeAttr('checked');});
                $("input[name='status'][value='"+data['status'].toLowerCase().split(' ')[0]+"'").attr('checked', 'checked');

                // Anime Type, Source, Rating, and the days for Broadcast (May be one of many values)
                // Here, We compair the API value with <option> tags values
                $('#input-anime_type option[value="'+data['type']+'"]').attr('selected', 'selected');
                $('#input-source option[id="'+data['source']+'"]').attr('selected', 'selected');
                $('#input-rating option[id="'+data['rating']+'"]').attr('selected', 'selected');
                $('#input-broadcast').val(data['broadcast']);

                // Inserting the tags of the anime
                // These tags stored in tow places
                // 1- div#tags element as children tags
                // 2- input#tags-container value
                // the tags are splitted by commas (,)
                // All Tags are translated into Arabic on the Server Side
                tags = $('#tags');

                // clear all saved tags first
                $("#tags-container").val('');
                tags.html('');
                data['genres'].forEach(genre => {
                    tags.html(
                        tags.html() +
                        '<div class="mx-3 my-2 p-2 bg-dark text-white rounded"><i class="close-me fa fa-times-circle p-1"></i>' +
                            genre['name'] +
                        '</div>'
                    );
                    $("#tags-container").val(
                        $("#tags-container").val() + 
                        genre['name'] + ','
                    );
                });

                // update hidden inputs whiche contain additional data
                // like favorites, image_url, trailer_url, MAL url

                $('input[name="favorites"]').val(data['favorites']);
                $('input[name="image_url"]').val(data['image_url']);
                $('input[name="members"]').val(data['members']);
                $('input[name="popularity"]').val(data['popularity']);
                $('input[name="rank"]').val(data['rank']);
                $('input[name="scored_by"]').val(data['scored_by']);
                $('input[name="trailer_url"]').val(data['trailer_url']);
                $('input[name="url"]').val(data['url']);

                $('#anime-image').attr('src', data['image_url']);

                // Change the Preview Card of the anime to the newest values
                // change_preview() takes no arguments
                change_preview();
            }
            
            // Prevent input from submitting the form
            // So, the user can press Enter to insert a new tag
            // without submitting the whole form
            $('#input-genres').keydown(function(event){
                // 13 is the Key Code for Enter button
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            
            // add tags to div#tags when the user presses Enter or comma (,)
            // and show the suggestions box with all correct suggestions only
            // we check for the user input on every key pressed
            var input = $('#input-genres');
            input.keyup(function(event){

                // The value of the input as Tag Name
                tagName = input.val();

                // Show the suggestions box and show only the correct suggestions
                $('#suggestions p').each(function () {
                    
                    // The Box and all suggestions are shown if the user pressess any key then remove it
                    // So, We need to check if the input value is not null and return if so
                    if (tagName == "") {$('#suggestions').hide();return}

                    // Show only the correct suggestions which starts with the user input
                    if ($(this).text().startsWith(tagName)) {

                        // The #suggestions box is hide by default. So, We need to display it first.
                        $('#suggestions').show();
                        
                        // display the suggestion
                        $(this).show();
                    } else {
                        // if the suggestion not starts with user input
                        // it will be hidden
                        $(this).hide();
                    }
                });
                
                // Don't do anything if input value is empty
                // or contains a single comma
                if (tagName == '' | tagName == ',') {return}

                // if the user pressed on comma (,) or Enter
                // We will get the contant of the input and store it in another input and div
                // Note: the comma key code is 188 and Enter key code is 13
                if (event.which == 188 | event.keyCode == 13) {
                    tags = $('#tags');
                    tags.html(
                        tags.html() +
                        '<div class="mx-3 my-2 p-2 bg-dark text-white rounded"><i class="close-me fa fa-times-circle p-1"></i>' +
                            tagName.split(',').join('') +
                        '</div>'
                    );

                    // store the tag name in the hidden input with other tags
                    // all tags are splitted with comma (,)
                    $("#tags-container").val(
                        $("#tags-container").val() + 
                        tagName.split(',').join('') + ','
                    );

                    // clear the input text
                    $('#input-genres').val('');
                }
                
            });

            // remove tags when click on close icon
            // every tag has an close icon with the class 'close-me'
            // we will remove the tag if the user clicked on this icon
            $('#tags').on('click', '.close-me', function(e){
                $(this).parent().remove();
                
                // remove the tag fron the hidden input
                // Note: every tag ends with comma (,)
                $("#tags-container").val(
                    $("#tags-container").val().split(
                        $(this).parent().text() + ','
                    ).join('')
                );
            });

            // Adding the suggestion tag if the user clicked on it
            // Here, We adding click event for every tag suggestion in the suggestions box
            $('#suggestions p').each(function () {
                $(this).click(function () {

                    // hide the suggestions box again
                    $('#suggestions').hide();

                    // clear the input field
                    input.val('');

                    // insert the new tag to the other tags
                    tags = $('#tags');
                    tags.html(
                        tags.html() +
                        '<div class="mx-3 my-2 p-2 bg-dark text-white rounded"><i class="close-me fa fa-times-circle p-1"></i>' +
                            $(this).text() +
                        '</div>'
                    );

                    // Note: all tags here are splitted with comma (,)
                    $("#tags-container").val(
                        $("#tags-container").val() + 
                        $(this).text() + ',');

                });
            });

            /**
            * This function changes the values of preview anime card
            * it takes no arguments but it takes the values dirctly from the form fields
            */
            function change_preview() {
                // Get the anime season from the aired_from data field
                var date = new Date($('#aired_from').val());
                month = date.getMonth() + 1;
                year = date.getFullYear();
                season = '';
                switch(month) {
                    case 12:
                    case 1:
                    case 2:
                        season = 'شتاء';
                    break;
                    case 3:
                    case 4:
                    case 5:
                        season = 'ربيع';
                    break;
                    case 6:
                    case 7:
                    case 8:
                        season = 'صيف';
                    break;
                    case 9:
                    case 10:
                    case 11:
                        season = 'خريف';
                    break;
                }

                // Change the preview context
                $('#preview-season').text(season + ' '+ year);
                $('#preview-title').text($('#input-name').val());
                $('#preview-status').text($('input[name="status"]:checked').val());
                $('#preview-episodes').text($('#input-episodes').val());
                $('#preview-rating').text($('#input-rating option:selected').text());
                $('#preview-tags').text($('#tags-container').val().split(',').join(', '));
                $('#preview-story').text($('#input-arabic_synopsis').val());
                $('#preview-score').text($('#input-score').val());
            }

            // Change Preview card when the user change an input value
            $('input, textarea').on('key change', function(){
                change_preview();
            });
            
            /** Update the cover preview image
            * @argument input: the input field 
            */
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // add the cover as a background
                        $('#coverImg').css('background-image', 'url('+e.target.result+')');
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            // adding the uploadd image to the hidden input field
            $("#file-input").change(function() {
                readURL(this);
            });
        </script>
    @endpush

    @include('dashboard.layouts.footers.auth')
</div>
@endsection
