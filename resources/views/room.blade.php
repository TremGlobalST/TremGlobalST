@extends('layouts.app')

@section('title', mb_strtoupper($room->title))

@section('content')
    <div id="app" class="bg">
        <div class="wrapper">
            <span class="date">
                Saat: @{{ date }}
            </span>

            <div class="content" v-if="whileMeet">
                <h1>{{ mb_strtoupper($room->title) }} TOPLANTI ODASI</h1>
                <span class="meet">
                    @{{ meetTitle.toUpperCase() }} TOPLANTISI
                </span>
                <span class="time">@{{ meetStart }} - @{{ meetEnd }}</span>
            </div>

            <div class="footer">
                <img src="/images/torlogo.svg" alt="">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const roomId = {{ $room->id }};
    </script>
@endsection
