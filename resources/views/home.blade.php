@extends('layouts.app')

@section('title', 'Toplantı Salonları')

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
@endsection
