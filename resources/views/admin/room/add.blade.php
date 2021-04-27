@extends('layouts.admin')

@section('title', 'Yeni Toplantı Odası')

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
                        <h1 class="m-0">Yeni Toplantı Odası</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Yeni Toplantı Odası</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header" style="background:#ec6724;color:#fff">
                        <h3 class="card-title">Toplantı Odası Oluştur</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('room_save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Oda Adı *</label>
                                        <input type="text" name="title" class="form-control" placeholder="Başlık" value="{{ old('title') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Oda Açıklaması</label>
                                        <textarea class="form-control" placeholder="Açıklama" name="description" value="{{ old('description') }}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Oda Teması</label>
                                        <input class="form-control" type="color" name="theme" value="{{ old('theme') ?? '#ec6724' }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="w-100 ml-auto">
                                                        <button class="btn btn-block btn-primary float-right" type="submit">Oluştur</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-2">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    @if (session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="card card-primary">
                                        <div class="card-body p-0">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
    <!-- fullCalendar 2.2.5 -->
        <script src="/plugins/moment/moment-with-locales.min.js"></script>
        <script src="/plugins/fullcalendar/main.js"></script>
        <script>
            const events = {!! json_encode($events) !!};
        </script>

        <script src="{{ mix('/js/calendar.render.js') }}"></script>
@endsection
