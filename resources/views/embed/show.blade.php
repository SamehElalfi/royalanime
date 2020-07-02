<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فيديو من رويال أنمي - أكبر موقع لمشاهدة الأنمي على الإطلاق</title>
    <link rel="stylesheet" href="/css/embed/videre.css">
    <link rel="stylesheet" href="https://unpkg.com/plyr@3/dist/plyr.css">
    <style>
    .container {width:100%;height: 100vh;}
    .container video {
        display:none;
    }
    * {
        
        transition: 0.5s;
    }
    #logo {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 9;
        width: 100%;
        opacity: 0.3;
        text-align: right;
    }
    #logo img {
        width: 10%;
    }
    #list * {
        font-family: tahoma, sans-serif;
        padding: 0 20px;
        cursor: pointer
        }
    #list {
        /* opacity: 0; */
        text-align: right;
    }
    #logo:hover {
        opacity: 1;
    }
    iframe {
        border: none;
    }
    </style>

</head>
<body style="background: url('/img/loading.png');background-size: cover;height: 100vh;
    overflow: hidden;">
    <div id="iframe"></div>
    <div class="container">
    <div href="https://www.royalanime.com/" style="" id="logo">
        <a href="https://www.royalanime.com/">
            <img src="https://cdn.royalanime.com/img/brand/white.webp">
        </a> 
        <div id="list">
            <div id="changeFullscreen" style="color:white;margin: 15px 0;">وضع ملئ الشاشة</div>
        </div>
    </div>
        <video controls crossorigin playsinline poster="">
            
        </video>
    </div>
    
    <script src="/js/jquery.min.js"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL"></script>
    <script src="https://unpkg.com/plyr@3"></script>
    <script src="https://cdn.rawgit.com/video-dev/hls.js/18bb552/dist/hls.min.js"></script>
    <script>
        var fullscreenList = [openFullscreen, closeFullscreen],
        c = 0;

        function openFullscreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { /* Firefox */
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { /* IE/Edge */
                document.documentElement.msRequestFullscreen();
            }
        }
        function closeFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }



        $('#changeFullscreen').click(function(e){  
            e.preventDefault();
            fullscreenList[c++%2]();
        });

    </script>
    <script>
        function getMatches(string,regex,index) {
            index || (index = 1);
            var matches = [];
            var match;
            while (match = regex.exec(string)) {
                matches.push(match[index]);
            }
            return matches;
        }
        function detect(str) {
            return (get_chunks(str).length > 0);
        }
        function get_chunks(str) {
            var chunks = str.match(/eval\(\(?function\(.*?(,0,\{\}\)\)|split\('\|'\)\)\))($|\n)/g);
            return chunks ? chunks : [];
        }
        function unpack(str) {
            var chunks = get_chunks(str),
                chunk;
            for (var i = 0; i < chunks.length; i++) {
                chunk = chunks[i].replace(/\n$/, '');
                str = str.split(chunk).join(unpack_chunk(chunk));
            }
            return str;
        }
        function unpack_chunk(str) {
            var unpacked_source = '';
            var __eval = eval;
            if (detect(str)) {
                try {
                    eval = function(s) { // jshint ignore:line
                        unpacked_source += s;
                        return unpacked_source;
                    }; // jshint ignore:line
                    __eval(str);
                    if (typeof unpacked_source === 'string' && unpacked_source) {
                        str = unpacked_source;
                    }
                } catch (e) {
                    // well, it failed. we'll just return the original, instead of crashing on user.
                }
            }
            eval = __eval; // jshint ignore:line
            return str;
        }
        function errorHandler() {
            $("body div").remove();
            $("body").css("background","url('/img/errors/undraw_page_not_found_su7k.png') 0% 0% / cover");
        }
        function playerHandler(url=0) {
            $('video').show();
            var controls =
            [
                'play-large', // The large play button in the center
                'rewind', // Rewind by the seek time (default 10 seconds)
                'play', // Play/pause playback
                'fast-forward', // Fast forward by the seek time (default 10 seconds)
                'restart', // Restart playback
                'progress', // The progress bar and scrubber for playback and buffering
                'current-time', // The current time of playback
                'duration', // The full duration of the media
                'mute', // Toggle mute
                'volume', // Volume control
                'captions', // Toggle captions
                'settings', // Settings menu
                'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
                'fullscreen' // Toggle fullscreen
            ];

            var player = new Plyr('video', { controls, quality:{default: 360} });
            
            // Expose player so it can be used from the console
            window.player = player;
            if (url != 0) {
                player.config.urls.download = url;
            }
        }

        function mp4upload(code) {
            var urls = [];
            var myRegEx = /script'>(eval.*?).split/g;
            var matches = getMatches(code, myRegEx, 1);
            var m = matches[0] + ".split('|')))";
            if (detect(m)) {
                var unpacked = unpack(m);
                var link = getMatches(unpacked, /src\("([^"]+)/g, 1);
                urls.push(link);
                console.log(link);
            }
            return urls;
        }
        function jawcloud(code) {
            var urls = [];
            var myRegEx = /source\ssrc="(https:.*?),(.*?),(.*?),[^"]*|source src="([^"]*)/g;
            var matches = myRegEx.exec(code);
            if (matches[4]&& matches[4].includes("m3u8")){
            var link = matches[4].replace(/,/g,'') ;
                if (!link.includes("window.jawplayer")) {
                    urls.push(link);
                }
            }else {
                for (i = 2; i < matches.length; i++) {
                    link = matches[1] + matches[i] + '/index-v1-a1.m3u8';
                    if (!link.includes("undefined") && !link.includes("window.jawplayer")) {
                        urls.push(link);
                    }
                }

            }
            console.log(urls);
            
            return urls;
        }
        function fembed(code) {
            // video_id = url.split('/')[-1];
            // api_url = "https://feurl.com/api/source/" + video_id;
            var urls = [];
            var myArr = code;
            for (i = 0; i < myArr['data'].length; i++) {
                var link = myArr['data'][i];
                if(link) {
                    urls.push([link['file'], link['label'].slice(0, -1)]);
                }
            }
            return urls
        }
        function mixdrop(code) {
            var urls = [];
            var myRegEx = /\s+?(eval\(function\(p,a,c,k,e,d\).+)\s+?/g;
            var matches = getMatches(code, myRegEx, 1);
            if (detect(matches[0])) {
                var unpacked = unpack(matches[0]);
                var link = "https:" + unpacked.match(/wurl=\"([^\"]+)/g)[0].replace('wurl="', '');
                console.log(unpacked.match(/wurl=\"([^\"]+)/g)[0].replace('wurl="', ''))
                urls.push(link);
                console.log(urls)
            }
            return urls
        }
        function vidoza(code) {
            var urls = [];
            var myRegEx = /sourcesCode\s*:\s*\[(.+?)\]/g;
            var matches1 = getMatches(code, myRegEx, 1);
            var matches2 = getMatches(matches1[0], /(["'].*v.mp4)/g, 1);

            qualityStart = matches1[0].search('res:"')+5
            quality = matches1[0].slice(qualityStart, qualityStart+4)
            if (quality[quality.length-1] == '"') {
                quality = quality.slice(0, quality.length-1)
            }

            var link = matches2[0].replace("\"", "");
            if (link.includes(".mp4")) {
                urls.push([link, quality]);
            }
            console.log(urls)
            return urls;
        }
        function vidlox(code) {
            var urls = [];
            var myRegEx = /sources\s*:\s*\[(.+?)\]/g;
            var matches = getMatches(code, myRegEx, 1);
            var res = matches[0].split("\",\"");
            for (i = 0; i < res.length; i++) {
                var link = res[i].replace("\"","");
                if (link.includes(".mp4")){
                    urls.push(link);
                }
            }
            return urls;
        }
        function vk(code) {
            urls = [];
            start = code.search(',"url') + 2;
            end = start + 2000;
            
            urls_code = code.slice(start, end).split(',').map(function (item) {
                a = item.split('":"');
                b = [];
                a.forEach(element => {
                    b.push(element.replace('url','').replace('"',''));
                });
                
                if (a[0].includes('144') || a[0].includes('240') || a[0].includes('360') || a[0].includes('480') || a[0].includes('720') || a[0].includes('1080')) {
                    urls.push(b);
                }
            });
            return urls;
        }
        function vidia(code) {
            urls = [];
            start = code.indexOf('label|srt|') + 10;
            end = code.indexOf('|play|this');
            // console.log(code)
            hashCode = code.slice(start, end);
            // Todo remove static server name
            urls.push(['https://s4.filescdn.co/hls/'+hashCode+'/index-v1-a1.m3u8']);
            return urls;
        }
        function cloudvideo (code) {
            urls = [];
            start = code.indexOf('m3u8|master|urlset|') + 19;
            end = code.indexOf('|src|sources|autoplay');
            c = code.slice(start, end).split('|');
            link = 'https://'+c[4]+'.'+c[3]+'.'+c[2]+'/'+c[1]+'/'+c[0]+'/index-v1-a1.m3u8'
            urls.push([link]);
            return urls;
        }
        function vidfast(code) {
            var urls = [];
            var myRegEx = /sources\s*:\s*\[(.+?)\]/g;

            var link = myRegEx.exec(code)[0].replace('sources: [{file:"', '')
            link = link.replace(',','').replace(',','').replace('.urlset/master','/index-v1-a1').slice(0, -3);
            urls.push([link]);
            return urls;
        }
        function streamtape (code) {
            urls = [];
            start = code.indexOf('//streamtape.com/get_video');
            end = start + code.slice(start, -1).indexOf('</div>');
            link = code.slice(start, end);
            urls.push([link]);
            return urls;
        }
        function gounlimited (code) {
            urls = [];
            start = code.indexOf('|video|type|') + 12;
            end = code.indexOf("'.split('|')");
            urlContents = code.slice(start, end).split('|');
            link = 'https://' + urlContents[1] + '.gounlimited.to/' + urlContents[0] + '/v.mp4';
            urls.push([link]);
            console.log(urls[0])
            return urls;
        }
        function sendvid(code) {
            urls = [];
            start = code.indexOf('var video_source = "') + 20;
            end = start + code.slice(start, -1).indexOf('";');
            link = code.slice(start, end);
            urls.push([link]);
            console.log(code)
            return urls;
        }


        // function 
        const url = 'https://cors-anywhere.herokuapp.com/{{ $url }}';
        const cors = '{{ $cors }}';
        const urlWithoutCors = '{{ $url }}';

        // TODO: Remove CORS error and stop using cors-anywhere.herokuapp.com
        // By using JSONP or fetch function
        try {
            if (url.includes('vk.com')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = vk(code);
                        urls.forEach(element => {
                            e = "<source src='" + cors + element[1].split("\\/").join("/") + "'  type='video/mp4' size='" + element[0] + "'>";
                            $('video').append(e);
                        });
                        playerHandler(urls[0][1].split("\\/").join("/"))
                    },
                    error: errorHandler
                });
            } else if (url.includes('vidlox')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = vidlox(code);

                        urls.forEach(element => {
                            e = "<source src='" + cors + element.split("\\/").join("/") + "'  type='video/mp4'>";
                            $('video').append(e);
                        });
                        playerHandler(urls[0].split("\\/").join("/"));
                    },
                    error: errorHandler
                });
            } else if (url.includes('vidoza')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = vidoza(code);
                        urls.forEach(element => {
                            e = "<source src='" + cors + element[0].split("\\/").join("/") + "'  type='video/mp4' size='" + element[1] + "'>";
                            $('video').append(e);
                        });
                        playerHandler(urls[0][0].split("\\/").join("/"));
                    },
                    error: errorHandler
                });
            // } else if (url.includes('mixdrop')) {
            //     var a = $.ajax({
            //         url: url,
            //         headers:{'x-requested-with':'XMLHttpRequest'},
            //         // dataType:'jsonp',
            //         success: function(code){
            //             var urls = mixdrop(code);

            //             urls.forEach(element => {
            //                 console.log(element)
            //                 e = "<source src='" +  element.split("\\/").join("/") + "'  type='video/mp4'>";
            //                 $('video').append(e);
            //             });
            //             playerHandler(urls[0].split("\\/").join("/"));
            //         },
            //         error: errorHandler
            //     });
            // } else if (url.includes('jawcloud')) {
            //     var a = $.ajax({
            //         url: url,
            //         headers:{'x-requested-with':'XMLHttpRequest'},
            //         // dataType:'jsonp',
            //         success: function(code){
            //             var urls = jawcloud(code);

            //             urls.forEach(element => {
            //                 console.log(element)
            //                 e = "<source src='" + cors + element.split("\\/").join("/") + "'  type='video/mp4'>";
            //                 $('video').append(e);
            //             });
            //             playerHandler(urls[0].split("\\/").join("/"));
            //         },
            //         error: errorHandler
            //     });
            // } else if (url.includes('fembed') || url.includes('feurl')) {
            //     var a = $.ajax({
            //         url: url,
            //         headers:{'x-requested-with':'XMLHttpRequest'},
            //         method: "POST",
            //         // dataType:'jsonp',
            //         success: function(code){
            //         var urls = fembed(code);

            //             urls.forEach(element => {
            //                 console.log(element)
            //                 e = "<source src='" + cors + element[0] + "'  type='video/mp4' size='" + element[1] + "'>";
            //                 $('video').append(e);
            //             });
                        
            //             playerHandler(urls[0][0]);
            //         },
            //         error: errorHandler
            //     });
            // } else if (url.includes('mp4upload')) {
            //     var a = $.ajax({
            //         url: url,
            //         headers:{'x-requested-with':'XMLHttpRequest'},
            //         // dataType:'jsonp',
            //         success: function(code){
            //             var urls = mp4upload(code);

            //             urls.forEach(element => {
            //                 console.log(element)
            //                 e = "<source src='" + cors + element[0] + "'  type='video/mp4' size='" + element[1] + "'>";
            //                 $('video').append(e);
            //             });
                        
            //             playerHandler(urls[0][0]);
            //         },
            //         error: errorHandler
            //     });
            } else if (url.includes('vidia.tv')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = vidia(code);

                        urls.forEach(element => {
                            const video = document.querySelector('video');
                            if (!Hls.isSupported()) {
                                $('video').attr("src", urlWithoutCors);
                            } else {
                                // For more Hls.js options, see https://github.com/dailymotion/hls.js
                                const hls = new Hls();
                                hls.loadSource(element[0]);
                                hls.attachMedia(video);
                                window.hls = hls;
                            }
                        });
                        
                        playerHandler();
                    },
                    error: errorHandler
                });
            } else if (url.includes('vidfast.co')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = vidfast(code);

                        urls.forEach(element => {
                            const video = document.querySelector('video');
                            if (!Hls.isSupported()) {
                                $('video').attr("src", urlWithoutCors);
                            } else {
                                // For more Hls.js options, see https://github.com/dailymotion/hls.js
                                const hls = new Hls();
                                hls.loadSource(element[0]);
                                hls.attachMedia(video);
                                window.hls = hls;
                                console.log(element[0]);
                            }
                        });
                        
                        playerHandler(urls[0][0]);
                    },
                    error: errorHandler
                });
            } else if (url.includes('cloudvideo.tv')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = cloudvideo(code);

                        urls.forEach(element => {
                            const video = document.querySelector('video');
                            if (!Hls.isSupported()) {
                                $('video').attr("src", urlWithoutCors);
                            } else {
                                // For more Hls.js options, see https://github.com/dailymotion/hls.js
                                const hls = new Hls();
                                hls.loadSource(element[0]);
                                hls.attachMedia(video);
                                window.hls = hls;
                                console.log(element[0]);
                            }
                        });
                        
                        playerHandler(urls[0][0]);
                    },
                    error: errorHandler
                });
            } else if (url.includes('streamtape')) {
                var a = $.ajax({
                    url: url,
                    headers:{'x-requested-with':'XMLHttpRequest'},
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = streamtape(code);

                        urls.forEach(element => {
                            const video = document.querySelector('video');
                            $('video').attr("src", cors + element[0]);
                        });
                        
                        playerHandler(urls[0][0]);
                    },
                    error: errorHandler
                });
            } else if (url.includes('gounlimited')) {
                // fetch(urlWithoutCors).then(function(response) {
                //     console.log(response.text());
                //     return response.text();
                // }).then(function(code) {
                //     var urls = gounlimited(code);
                //     console.log(code, urls)

                //     urls.forEach(element => {
                //         const video = document.querySelector('video');
                //         $('video').attr("src", element[0]);
                //     });
                    
                //     playerHandler();
                // });
                var a = $.ajax({
                    url: urlWithoutCors,
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = gounlimited(code);

                        urls.forEach(element => {
                            const video = document.querySelector('video');
                            $('video').attr("src", cors + element[0]);
                        });
                        
                        playerHandler(urls[0][0]);
                    },
                    error: errorHandler
                });
            } else if (url.includes('sendvid')) {
                var a = $.ajax({
                    url: urlWithoutCors,
                    headers:{
                        'x-requested-with':'XMLHttpRequest',
                        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36 Edg/83.0.478.45'
                        },
                    // dataType:'jsonp',
                    success: function(code){
                        var urls = sendvid(code);

                        urls.forEach(element => {
                            const video = document.querySelector('video');
                            $('video').attr("src", cors + element[0]);
                        });
                        
                        playerHandler(urls[0][0]);
                    },
                    error: errorHandler
                });
            } else if (url.includes('google')) {
                // TODO: Extract Google view ID
                e = `<iframe src="`+urlWithoutCors+`" style=" width: 100%; height: 100vh; "></iframe> `
                $('#iframe').append(e);
                // var a = $.ajax({
                //     url: urlWithoutCors,
                //     headers:{
                //         'x-requested-with':'XMLHttpRequest',
                //         'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36 Edg/83.0.478.45'
                //         },
                //     // dataType:'jsonp',
                //     success: function(code){
                //         var urls = sendvid(code);

                //         urls.forEach(element => {
                //             const video = document.querySelector('video');
                //         });
                        
                //         playerHandler();
                //     },
                //     error: errorHandler
                // });
            } else {
                $( document ).ready( () => {
                    console.log('else')
                    e = "<iframe style='width:100%; height:100vh' src='" + urlWithoutCors + "'></iframe>";
                    // $('video').attr("src", urlWithoutCors);
                    $('#iframe').append(e);
                    // playerHandler();
                });
            }
        } catch(err) {
            console.log('Catch Error: '+ err)
            errorHandler();
        }
    </script>
</body>
</html>