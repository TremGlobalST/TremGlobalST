@extends('layouts.app')

@section('title', 'Welcome to TremGlobal')

@section('links')
    <style type="text/css">
         @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
    html, body {
      margin: 0;
      padding: 0;
      background: url(images/bg_welcome.jpg) no-repeat;
      background-size: auto;
    }
    img#bo{
      position: absolute;
      left: 0;
      bottom: 0;
      width: 45.5%;
    }
    #logo-wrapper {
      display: flex;
      justify-content: space-between;
      padding: 2.5rem;
      height: auto;
      align-items: flex-start;
    }
    #logo-wrapper img.invest{
      width: 14%;
    }
    #content {
      display: flex;
      flex-direction: column;
      width: 51%;
      margin-left: 46.8%;
      height: auto;
      justify-content: space-between;
      align-items: center;
    }
    #content .welcomeText {
      font-family: 'Bebas Neue', cursive;
      width: 764px;
      height: 318px;
      background: url(images/textbg.svg) no-repeat;
      background-size: auto;
      color: #fff;
      text-align: center;
      line-height: 7.5rem;
      justify-content: center;
    }
    .Words-line {
            overflow: hidden;
            position: relative;
        }

        .Words-line:nth-child(odd) {
            transform: skew(0deg, -7deg) scaleY(0.96667);
        }

        .Words-line:nth-child(even) {
            transform: skew(0deg, -3deg) scaleY(1.33333);
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


        .Words-line2 {
            overflow: hidden;
            position: relative;
        }

        .Words-line2:nth-child(odd) {
            transform: skew(0deg, -3deg) scaleY(0.66667);
        }

        .Words-line2:nth-child(even) {
            transform: skew(0deg, -7deg) scaleY(1);
        }

        .Words-line2:nth-child(1) {
            left: 29px;
        }

        .Words-line2:nth-child(2) {
            left: 58px;
        }

        .Words-line2:nth-child(3) {
            left: 87px;
        }

        .Words-line2:nth-child(4) {
            left: 116px;
        }

        .Words-line2:nth-child(5) {
            left: 145px;
        }

        .Words-line2:nth-child(6) {
            left: 174px;
        }

        .Words-line2:nth-child(7) {
            left: 203px;
        }

        .first {
          margin-top: 1.5rem;
          font-size: 6rem;
          margin-left: -5.5rem;
          font-stretch: 50%;
          line-height: 7.5rem;
        }
        .second {
          font-size: 10rem;
          margin-left: -5rem;
          line-height: 12rem;
          margin-top: -2.5rem;
        }
        img.sign {
          width: 55%;
          height: auto;
          margin-top: -4rem;
        }
        .video-container {
            width: 100%;
            height: 408px;
            overflow: hidden;
            position: relative;
            margin-top: -1rem;
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
        @media (max-width: 1680px) {
          #logo-wrapper {
          padding: 2.5rem 2.5rem 0;
          }
        }
    </style>
@endsection

@section('content')
<img src="/images/bo.svg" id="bo">
<div id="logo-wrapper">
  <img src="/images/invest.svg" class="invest">
  <img src="/images/tremglobal.svg" class="invest">
  <img src="/images/torholding.svg" class="invest">
</div>
<div id="content">
  <div class="welcomeText">
    <div class="en">
      <div class="Words-line first">{{ $welcome->welcome_text ?? 'welcome to' }}</div>
    <div class="Words-line2 second">{{ $welcome->welcome_sub_text ?? 'our famıly...' }}</div>
    </div>
  </div>
  <img src="/images/imza.svg" class="sign">
  <div class="video-container">
      <div class="video-foreground">
          <div id="player"></div>
      </div>
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
