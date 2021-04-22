@extends('layouts.admin')

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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Toplantı Oluştur</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('meet_save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6 mx-auto">
                                    <div class="form-group">
                                        <label for="">Toplantı Odası *</label>
                                        <select name="room" id="" class="form-control">
                                            @foreach($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Toplantı Başlığı *</label>
                                        <input type="text" name="title" class="form-control" placeholder="Başlık" value="{{ old('title') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Toplantı Açıklaması</label>
                                        <textarea class="form-control" placeholder="Açıklama" name="description" value="{{ old('description') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Başlangıç *</label>
                                        <div class="input-group date" id="reservationdatetime_start" data-target-input="nearest">
                                            <input type="text" name="start_date" class="form-control datetimepicker-input"
                                                   data-target="#reservationdatetime_start" data-toggle="datetimepicker"
                                                   autocomplete="off"
                                                    required value="{{ old('start_date') }}"/>
                                            <div class="input-group-append" data-target="#reservationdatetime_start" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Bitiş *</label>
                                        <div class="input-group date" id="reservationdatetime_end" data-target-input="nearest">
                                            <input type="text" name="end_date" class="form-control datetimepicker-input"
                                                   data-target="#reservationdatetime_end" data-toggle="datetimepicker"
                                                   autocomplete="off"
                                                    required value="{{ old('end_date') }}"/>
                                            <div class="input-group-append" data-target="#reservationdatetime_end" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mx-auto">
                                    <div class="row">
                                        <div class="col">
                                            <div class="w-25 ml-auto">
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
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
            <script>
                const meets = {!! json_encode($rooms) !!}
                $(document).ready(function() {
                    $('#reservationdatetime_start').datetimepicker({ icons: { time: 'far fa-clock' }, format: 'Y-MM-DD HH:mm'});
                    $('#reservationdatetime_end').datetimepicker({ icons: { time: 'far fa-clock' }, format: 'Y-MM-DD HH:mm' });
                });
            </script>
@endsection
