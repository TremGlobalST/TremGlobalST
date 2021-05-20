@extends('layouts.app')

@section('title', 'TV Screen')

@section('links')
    <style>
        .video-container {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .video-container iframe,
            {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .video-container iframe {
            position: absolute;
            top: -60px;
            left: 0;
            width: 100%;
            height: calc(100% + 120px);
        }
        .video-foreground:hover > button {
            opacity: .6;
        }
        button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1;
            border: 1px solid #fff;
            border-radius: 3px;
            font-size: 18px;
            color: #fff;
            background: transparent;
            opacity: 0;
            cursor: pointer;
        }
        /*
            .video-container iframe,
                {
                pointer-events: none;
            }

            

            .video-foreground {
                pointer-events: none;
            } */

    </style>
@endsection

@section('content')
    <div class="video-container">
        <div class="video-foreground">
            <div id="player"></div>
            <button>Full Screen</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '100%',
                width: '100%',
                videoId: '{{ $tv->code }}',
                allowfullscreen: true,
                playerVars: {
                    'playsinline': 1,
                    'autoplay': 1,
                    'mute': 1,
                    'loop': 1,
                    'enablejsapi': 1,
                    'controls': 0
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        var $ = document.querySelector.bind(document);

        function setupListener() {
            $('button').addEventListener('click', playFullscreen);
        }

        function playFullscreen() {
            var iframe = $('#player');
            //debugger;
            var requestFullScreen = iframe.requestFullScreen || iframe.mozRequestFullScreen || iframe
                .webkitRequestFullScreen;
            if (requestFullScreen) {
                requestFullScreen.bind(iframe)();
            }

            
        }

        function onPlayerReady(event) {
                event.target.playVideo();
                player.setLoop(true);
                setupListener();


            }

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.ENDED) {
                player.playVideo();
                jQuery('button').css('opacity', 0);
            }
        }

        function stopVideo() {
            /* player.stopVideo(); */
        }

    </script>
@endsection
