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
                                <div class="alert alert-info">
                                <ul>
                                @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name" style="margin-top: 30px">Enter employee full name:</label>
                                <input class="form-control" style="border-color: black;" type="text" name="name" value="{{$profile->value('name')}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Enter employee email:</label>
                                <input class="form-control" style="border-color: black;" type="email" name="email" value="{{$profile->value('email')}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="user_name">Enter employee username:</label>
                                <input class="form-control" style="border-color: black;" type="text" name="user_name" value="{{$profile->value('user_name')}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Enter employee telephone number:</label>
                                <input class="form-control"  style="border-color: black;" type="text" name="telephone" value="{{$profile->value('telephone')}}" readonly>
                            </div>
                            <a type="submit" href="{{route('profile.edit')}}" class="btn btn-primary" style="margin-top: 10px; margin-left: auto;" >Edit profile</a>
                            <a type="submit" href="{{route('profile.editp')}}" class="btn btn-info" style="margin-top: 10px;">Edit password</a>
                            <a type="button" data-toggle="modal" data-target="#deleteModal" data-whatever="{{$profile->value('user_name')}}" class="btn btn-danger" style="margin-top: 10px;">Delete</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection



@section('scripts')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    If you are the admin of the anbar page, then deleting your account will delete the entire anbar page <br>
                    Do you really want to remove your account "{{$profile->value('user_name')}}"?
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{route('profile.delete')}}">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Not</button>
                        <button type="submit"  id="for_button" class=" btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </script>


    <script>

                $("#for_button").click(function() {
                $.ajax({
                    type:'POST',
                    url:"http://ambar/profile/delete",
                    data:{ 'brand_id' : recipient },
                    success:function (){

                    },
                    error: function(xhr) {
                        alert("ошибка передачи данных");
                    },
                });
            });
    </script>




@endsection

