@extends('anbar.layouts.layout')
@section('active4')
    active
@endsection

@section('title')
    <title>Anbar | Brand table</title>
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
                        <h1 class="m-0 text-dark">Brands table</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index.main')}}">Home</a></li>
                            <li class="breadcrumb-item active">Brands table</li>
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

                    <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('brand.update',['id' => $id])}}" >
                        @csrf
                        <div class="form-group">
                            <label for="brand_name">Update brand name:</label>
                            <input type="text" class="form-control" name="brand_name" placeholder="..." value="{{$brands->value('brand_name')}}" required >
                        </div>
                        <div class="custom-file" >
                            <input type="file" class="custom-file-input" name="brand_photo">
                            <label class="custom-file-label" for="brand_photo">Choose the new brand logo photo...</label>
                        </div><br>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Update</button>
                        <a href="{{route('brand.create')}}" class="btn btn-danger" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;">Back</a>
                    </form>
                    </div>
                    <div class="col-4">
                        <img src="{{asset('storage/'.$brands->value('photo'))}}" style="width:100px; height:70px; margin-top:45px; margin-left: 20px;">
                    </div>
                </div>
                </div>
            <div class="card">
                <div class="card-header">

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Brand name</th>
                            <th>Logo photo</th>
                            <th>Date</th>
                            <th>processing buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        @foreach($branda as $brand)
                            <tr>
                                <?php $i++;
                                echo "<td>{$i}</td>"
                                ?>
                                <td>{{$brand->brand_name}}</td>
                                <td><img style="width:100px; height:70px;" src="{{asset('storage/'.$brand->photo)}}"></td>
                                <td>{{$brand->updated_at}}</td>
                                <td>
                                    <form action="{{route('brand.edit', ['id' => $brand->id ])}}" method="post">
                                        <a href="#" class="btn btn-info" style="margin-right: 10px;">Edit</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Brand name</th>
                            <th>Logo photo</th>
                            <th>Date</th>
                            <th>processing buttons</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
    </div>


@endsection


@section('scripts')
    <script src="{{asset('assets/main/index/js/database.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

@endsection
