@extends('layouts.app')

@section('title', 'Welcome to TremTurkey')

@section('links')
    <style type="text/css">
         @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
    html, body {
      margin: 0;
      padding: 0;
    }
    #logo-wrapper {
      display: flex;
      justify-content: center;
      height: auto;
      align-items: center;
      padding: 1rem;
    }
    #logo-wrapper img{
      width: 30%;
    }
    
        .video-container {
            width: 100%;
            height: 608px;
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
        .ofs{
        position: absolute;
        top: 10px;
        right: 10px;
        opacity: 0;
        border: none;
        background: #dedede;
        box-shadow: 2px 2px 6px 3px #ccc;
        padding: 20px;
        font-weight: bold;
        font-size: 22px;
        color: gray;
    }

        @media (max-width: 1680px) {
          #logo-wrapper {
          padding: 1rem;
          }
        }
    </style>
@endsection

@section('content')
<div onclick="toggleBtns()">
<div id="logo-wrapper">
  <img src="/images/tremturkey_logo.png" class="invest">
</div>
<div id="content">
  <div class="video-container">
      <div class="video-foreground">
          <div id="player"></div>
      </div>
  </div>
  
</div>
<button class="ofs" onclick="toggleFullscreen(event)">fullscreen</button>
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
    <script>
      /* Get the documentElement (<html>) to display the page in fullscreen */
      var elem = document.documentElement;

      var showBtn = false;
      var isFull = false;

      function toggleBtns() {
          if (showBtn) {
              document.getElementsByClassName('ofs')[0].style.opacity = 0;
          } else {
              document.getElementsByClassName('ofs')[0].style.opacity = 1;
          }
          showBtn = !showBtn;
      }

      function toggleFullscreen(e) {
          if (isFull) {
              closeFullscreen(e);
          } else {
              openFullscreen(e);
          }
          isFull = !isFull;
      }
      
      /* View in fullscreen */
      function openFullscreen(e) {
          e.preventDefault();
        if (elem.requestFullscreen) {
          elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
          elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
          elem.msRequestFullscreen();
        }
      }
      
      /* Close fullscreen */
      function closeFullscreen(e) {
          e.preventDefault();
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE11 */
          document.msExitFullscreen();
        }
      }
      </script>
@endsection
