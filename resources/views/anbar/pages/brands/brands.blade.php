@extends('anbar.layouts.layout')
@section('active4')
    active
@endsection

@section('title')
    <title>Anbar | Brands table</title>
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
            <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('brand.store')}}">
                @csrf
                <div class="form-group">
                    <label for="brand_name">Enter brand name:</label>
                    <input type="text" class="form-control" name="brand_name" placeholder="..." required >
                </div>
                <div class="custom-file " >
                    <input type="file" class="custom-file-input" name="brand_photo" id="brand_photo"  required>
                    <label class="custom-file-label" for="brand_photo">Choose brand logo photo...</label>
                </div><br>
                <button type="submit" name="add" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Add</button>
            </form>
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
                        @foreach($brands as $brand)
                        <tr>
                            <?php $i++;
                            echo "<td>{$i}</td>"
                            ?>
                            <td>{{$brand->brand_name}}</td>
                            <td><img style="width:100px; height:70px;" src="{{asset('storage/'.$brand->photo)}}"></td>
                            <td>{{$brand->updated_at}}</td>
                            <td>
                                <form method="post">
                                    {!! csrf_field() !!}
                                <a href="{{route('brand.edit', ['id' => $brand->id ])}}" class="btn btn-info" style="margin-right: 10px;margin-bottom: 10px" >Edit</a>
                                <button type="button" class="btn btn-danger" value="{{$brand->brand_name}}" data-toggle="modal" data-target="#deleteModal" style="margin-bottom: 10px" data-whatever="{{$brand->brand_name}}" data-whatever1="{{$brand->id}}">
                                    Delete
                                </button>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                        <form method="post" action="{{route('brand.delete',['id' => 'delete'])}}">
                            @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Not</button>
                        <button type="submit"  id="for_button" class=" btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/main/index/js/database.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>


    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
           let recipient = button.data('whatever');
            let id = button.data('whatever1');
            let modal = $(this);
            modal.find('.modal-body').text('Do you really want to remove the brand "' + recipient + '"?');
            $("#for_button").click(function() {
            $.ajax({
                type:'POST',
                url:"http://ambar/brands/"+ id,
                data:{ 'brand_id' : recipient },
                success:function (){

                },
                error: function(xhr) {
                    alert("ошибка передачи данных");
                },
            });
            })
        });
    </script>


@endsection

