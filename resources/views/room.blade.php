@extends('layouts.app')

@section('title', mb_strtoupper($room->title))

<style>
    .ytp-show-cards-title {
        display: none;
    }
</style>

@section('content')
    <div id="app" class="bg">
        <div class="wrapper">
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

            <div class="video-wrapper" v-if="noMeet">
                <video width="auto" height="100%"  autoplay muted loop>
                    <source src="/videos/ad.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="footer">
                <img src="/images/torlogo.svg" alt="">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/vue.app.js') }}" defer></script>
    <script>
        const roomId = {{ $room->id }};
    </script>
@endsection
