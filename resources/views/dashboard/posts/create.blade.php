@extends('dashboard.layouts.app', ['title' => __('dashboard.Add Episode')])

@section('content')
@include('dashboard.users.partials.header', [
    'title' => __('dashboard.Add New Post'),
    'description' => __('dashboard.Fill this form to create an post, please note that any empty field willbe shown as unknown'),
])   

<div class="container-fluid mt--7">
    <form method="post" action="{{ route('posts.store') }}" autocomplete="off" enctype="multipart/form-data">
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
                            <h3 class="col-12 mb-0">{{ __('dashboard.Add New Post') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            {{-- The title of the post --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-title">{{ __('dashboard.The Title') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('title'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('title') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" name="title" id="input-title" class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}" value="{{ old('title') ?? '' }}" min="0" placeholder="عنوان الموضوع">
                            </div>

                            <textarea id="mytextarea" name="content" placeholder="محتويات المقالة">
                                {{ old('post') }}
                            </textarea>

                            @push('js')
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js" referrerpolicy="origin"></script>
                                <script>
                                    tinymce.init({
                                        selector: '#mytextarea',
                                        // inline:true,
                                        plugins: [
                                            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                                            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                                            'table emoticons template paste help'
                                        ],
                                        language: 'ar',
                                        language_url : '/js/tinymce/ar.js',
                                        directionality : 'rtl',
                                        a_plugin_option: true,
                                        a_configuration_option: 400,
                                        height: 600,
                                        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor emoticons',
                                        menu: {
                                            file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
                                            edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
                                            view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
                                            insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
                                            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
                                            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
                                            table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
                                            help: { title: 'Help', items: 'help' },
                                            favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
                                        },
                                        menubar: 'favs file edit view insert format tools table help',
                                        
                                    relative_urls: false,
                                    file_picker_callback: function (callback, value, meta) {
                                        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                        let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                                        let type = 'image' === meta.filetype ? 'Images' : 'Files',
                                            url  = '/filemanager?editor=tinymce5&type=' + type;

                                        tinymce.activeEditor.windowManager.openUrl({
                                            url : url,
                                            title : 'Filemanager',
                                            width : x * 0.8,
                                            height : y * 0.8,
                                            onMessage: (api, message) => {
                                                callback(message.content);
                                            }
                                        });
                                    }
                                    });
                                </script>
                            @endpush
                            <hr class="my-6" />
               
                            {{-- The Anime Tags (Tags e.g. Action, Magic .. etc) --}}
                            {{-- All tags are splitted with commas (,) and stored in another two places --}}
                            {{-- 1- the hidden input called 'tags' as a text => "Action, Adventure,"--}}
                            {{-- 2- the suggestions div tag as children divs --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-tags">{{ __('dashboard.Tags') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('tags'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('tags') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {{-- The tags will be automaticlly stored when user press Enter or comma (,) --}}
                                <input type="text" id="input-tags" class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" placeholder="أكشن, مغامرات">

                                {{-- here the actual tags are stored --}}
                                {{-- all tags are translated into Arabic on the server side (AnimeController@store) --}}
                                <input type="hidden" name="tags" id="tags-container" value="{{ old('tags') }}">

                                {{-- When the user trying to write a new tag, the next box will be displayed--}}
                                {{-- and this box contains all suggesstions for the tag --}}
                                {{-- So, the user doesn't need to write the full text of the tag --}}
                                <div id="suggestions" class="bg-white border border-top-0 position-absolute">
                                    {{-- @foreach ($tags ?? '' as $tag)
                                        <p class="py-2 px-6 mb-0" style="display:none;cursor: pointer;">{{ $tag }}</p>
                                    @endforeach --}}
                                </div>

                                <span class="text-muted h5 my-1">  * {{ __('dashboard.Separate tags with commas') }}</span>

                                {{-- When the user add a new tag, it will be showen in this div as child --}}
                                {{-- and all inserted tags has the option to be removed by clicking on close icon --}}
                                <div id="tags" class="row"></div>
                            </div>

                                                        
                            {{-- The other names for the anime --}}
                            {{-- English Title --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-slug">{{ __('dashboard.English Title') }}</label>
                                
                                {{-- Display an error message here --}}
                                @if ($errors->has('slug'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('slug') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <input type="text" name="slug" id="input-slug" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="Fullmetal Alchemist: Brotherhood" value="{{ old('slug') }}">
                            </div>

                            
                            <hr class="my-6" />
                            
                            {{-- The date of this episodes --}}
                            {{-- <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label d-block" for="input-published_at">{{ __('dashboard.Publishing Date') }}</label>
                                    
                                    @if ($errors->has('published_at'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('published_at') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <input type="date" id="published_at" name="published_at" class="rounded p-3{{ $errors->has('published_at') ? ' border-danger' : ' border' }}" value="{{ old('published_at') }}">
                                </div>
                            </div> --}}

                            {{-- Notes --}}
                            <div class="form-group">
                                <label class="form-control-label" for="input-summary">{{ __('dashboard.Summary') }}</label>

                                {{-- Display an error message here --}}
                                @if ($errors->has('summary'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('summary') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <textarea id="input-summary" name="summary" autocomplete="false" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" rows="4" placeholder='الموضوع في ما لا يتجاوز 500 حرف'>{{ old('summary') }}</textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('dashboard.Add Post') }}</button>
                                <button class="btn mt-4">{{ __('dashboard.Preview') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Anime Card --}}
            <div class="col-xl-4 mt-5 mt-xl-0">
                <div class="card card-profile shadow border-0 rounded overflow-hidden my-5 my-xl-0">
                    
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
                    </div>
                    <div class="card-body pt-0 mt--5">
                        <h3 class="text-center text-white mb-5" id="preview-title">
                            Fullmetal Alchemist: Brotherhood
                        </h3>
                        <div class="text-center">
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
                data['tags'].forEach(genre => {
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
            $('#input-tags').keydown(function(event){
                // 13 is the Key Code for Enter button
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            
            // add tags to div#tags when the user presses Enter or comma (,)
            // and show the suggestions box with all correct suggestions only
            // we check for the user input on every key pressed
            var input = $('#input-tags');
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
                    $('#input-tags').val('');
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
