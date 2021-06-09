@extends('layouts.app')

@section('title', mb_strtoupper($room->title))

<style>
    .ytp-show-cards-title {
        display: none;
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
</style>

@section('content')
    <div id="app" class="bg">
        <div class="wrapper" onclick="toggleBtns()">
            <span class="date" v-if="whileMeet || startingMeet">
                Saat: @{{ date }}
            </span>

            <span class="room-name" v-if="noMeet">
                {{ mb_strtoupper($room->title) }} TOPLANTI ODASI
            </span>

            <div class="content" v-if="whileMeet || startingMeet">
                <h1>{{ mb_strtoupper($room->title) }} TOPLANTI ODASI</h1>
                <span class="meet" v-if="whileMeet">
                    @{{ meetTitle.toUpperCase() }} TOPLANTISI
                </span>
                <span class="meet-starting" v-if="startingMeet">
                    @{{ remainingTime }}'dk sonra <span class="meet-name">"@{{ meetTitle }}"</span> toplantısı başlaması planlanıyor.
                </span>
                <span class="time">@{{ meetStart }} - @{{ meetEnd }}</span>
            </div>

            <div class="video-wrapper" v-if="noMeet" style="height:80%">
                <video width="auto" height="100%"  autoplay muted loop>
                    <source src="/videos/ad.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="footer">
                <img src="/images/torlogo.svg" alt="">
            </div>
            <button class="ofs" onclick="toggleFullscreen(event)">fullscreen</button>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/vue.app.js') }}" defer></script>
    <script>
        const roomId = {{ $room->id }};
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
