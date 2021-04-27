@extends('layouts.admin')

@section('title', 'Meeting')

@section('links')
    <link rel="stylesheet" href="/plugins/fullcalendar/main.css">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @foreach($rooms as $room)
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box" style="background: {{ $room->theme }}; color: #fff">
                                <div class="inner">
                                    <h3>{{ $room->title }}</h3>

                                    <p>{{ count($room->meets) }} Toplantı</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
                                </div>
                                <a href="{{ route('room_edit', ['id' => $room->id]) }}" class="small-box-footer">Düzenle <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
@endsection

@section('scripts')
    <!-- fullCalendar 2.2.5 -->
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/fullcalendar/main.js"></script>
        <script>
            const events = {!! json_encode($events) !!};
        </script>
        <script src="{{ mix('/js/calendar.render.js') }}"></script>
@endsection
