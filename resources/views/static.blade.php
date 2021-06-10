@extends('layouts.app')

@section('title', 'Welcome to TremGlobal')

@section('links')
<style>
    .wrapper {
        
    }
    img {
        width: 100%;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
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
@endsection

@section('content')
    <div onclick="toggleBtns()" class="wrapper">
        <img src="/images/static.png">
        <button class="ofs" onclick="toggleFullscreen(event)">fullscreen</button>
    </div>
@endsection

@section('scripts')
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
            } else if (elem.webkitRequestFullscreen) {
                /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE11 */
                elem.msRequestFullscreen();
            }
        }

        /* Close fullscreen */
        function closeFullscreen(e) {
            e.preventDefault();
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                /* Safari */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                /* IE11 */
                document.msExitFullscreen();
            }
        }

    </script>
@endsection
