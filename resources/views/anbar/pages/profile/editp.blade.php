@extends('anbar.layouts.layout')

@section('active2')
    active
@endsection

@section('title')
    <title>Anbar | Profile</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/main/index/css/database.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index.main')}}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><hr><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-5">
                        <img style="width:150px; height:130px; border: 2px solid black; display: block; margin: 0 auto;" src="{{asset('storage/images/profile.png')}}">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" class="was-validated"  action="{{route('profile.updatep')}}">
                            @csrf
                            <div class="form-group">
                                <label style="margin-top: 30px;" for="user_name">Enter new password:</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="*************" required>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Repeat new password:</label>
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="*************" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Update</button>
                            <a href="{{route('profile.index')}}" class="btn btn-danger" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection




