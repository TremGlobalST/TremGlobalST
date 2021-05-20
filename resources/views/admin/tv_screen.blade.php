@extends('layouts.admin')

@section('title', 'TV Screen')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">TV Ekranı</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">TV Ekranı</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">TV Ekranı Ayarları</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('video_save') }}" method="POST">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-10">
                                    <label class="mr-sm-2" for="inlineFormInput">Youtube Video Code (e.g. 3EnUYify6AA)</label>
                                    <input type="text" class="form-control mb-2" id="inlineFormInput"
                                        placeholder="exmp: 3EnUYify6AA" name="code" value="{{ $tv->code }}" required>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary mt-4">Kaydet</button>
                                </div>
                            </div>
                        </form>
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
        </section>
    </div>
@endsection
