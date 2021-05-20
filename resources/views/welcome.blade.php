@extends('layouts.app')

@section('title', 'Welcome to TremGlobal')

@section('links')
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Basic&display=swap');

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: 'Basic', sans-serif;
        }

        body {
            background: #ecdfce;
        }

        #header {
            background: url({{ $welcome->header_image ?? '/images/burak-ozcivit-commercial-desktop2.jpg' }}) no-repeat;
            background-size: cover;
            width: 100%;
            height: 350px;
        }

        #content {
            display: flex;
            margin-top: 0;
            justify-content: center;
            align-items: center;
        }

        #content .item-phone {
            background: url(/images/turkish-citizenship-acquisition-process.png) no-repeat;
            background-size: cover;
            width: 15%;
            height: 350px;
        }

        #content .video-container {
            width: 45%;
            height: 300px;
            border-radius: 5px;
            box-shadow: 0 0 36px 3px #ce713b;
            margin: 0 2rem;
        }

        #content .logos {
            width: 20%;
            height: auto;
        }

        #content .logos img {
            margin: 1rem;
        }

        #welcome-text {
            position: absolute;
            font-size: 3rem;
            line-height: 3rem;
            top: 9%;
            left: 35%;
            /*font-weight: 700;*/
            color: #fff;
            text-shadow: 1px 1px #ce713b;
            text-align: center;

            background: #000;
            padding: .1rem;
            border-radius: 15px;
            box-shadow: 20px 11px 18px 2px #ce713b;
            text-transform: uppercase;
            // Sort out nasty text fuzz
            transform: translate3d(0, 0, 0);
            -webkit-font-smoothing: antialiased;
            -webkit-font-kerning: normal;
            -webkit-text-size-adjust: 100%;
            width: 30%;
        }

        .Words-line {
            overflow: hidden;
            position: relative;
        }

        .Words-line:nth-child(odd) {
            transform: skew(60deg, -6deg) scaleY(0.66667);
        }

        .Words-line:nth-child(even) {
            transform: skew(0deg, -6deg) scaleY(1.33333);
        }

        .Words-line:nth-child(1) {
            left: 29px;
        }

        .Words-line:nth-child(2) {
            left: 58px;
        }

        .Words-line:nth-child(3) {
            left: 87px;
        }

        .Words-line:nth-child(4) {
            left: 116px;
        }

        .Words-line:nth-child(5) {
            left: 145px;
        }

        .Words-line:nth-child(6) {
            left: 174px;
        }

        .Words-line:nth-child(7) {
            left: 203px;
        }
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
        @media (min-width: 1680px) {
            #welcome-text {
                top: 4%;
            }
            #content .video-container {
                width: 65%;
            height: 500px;
            }
            #content {
            margin-top: 4rem;
        }
        }
    </style>
@endsection

@section('content')
    <div id="header"></div>
    <div id="welcome-text" class="Words-line">
        {{ $welcome->welcome_text ?? 'welcome to our famıly...' }}
    </div>
    <div id="content">
        <div class="logos">
            <img src="/images/tremglobal-logo.svg">
            <img src="/images/torlogo.svg">
        </div>
        <div class="video-container">
            <div class="video-foreground">
                <div id="player"></div>
            </div>
        </div>
        <div class="item-phone"></div>
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
                videoId: '{{ $welcome->code ?? "8iwD-dHm9Uo" }}',
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
            //$('button').addEventListener('click', playFullscreen);
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
                //setupListener();


            }

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.ENDED) {
                player.playVideo();
                //jQuery('button').css('opacity', 0);
            }
        }

        function stopVideo() {
            /* player.stopVideo(); */
        }

    </script>
@endsection
