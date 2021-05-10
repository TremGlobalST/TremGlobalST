@extends('layouts.app')

@section('title', 'Toplantı Salonları')

@section('links')
<style>
.tv-link{
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 200px;
    height: 100px;
    background: red;
    color: #fff;
    box-shadow: 0 0 6px 3px #ccc;
}
.tv-link a{
    width: 100%;
    height: 100%;
    text-align: center;
    color: #fff;
    text-decoration: none;
    display: block;
    line-height: 100px;
    font-size: 17px;
}
</style>
@endsection

@section('content')
    <div class="rooms">
        @foreach($rooms as $room)
            <a href="{{ route('room', ['slug' => $room->slug]) }}">
                <div class="room" style="background:{{ $room->theme }}">
                    {{ $room->title }}
                </div>
            </a>
        @endforeach
    </div>
    <div class="tv-link">
        <a href="{{ route('tv_screen') }}">
            TV Ekranı
        </a>
    </div>
@endsection
