@extends('anbar.layouts.layout')

@section('active3')
    active
@endsection

@section('title')
    <title>Anbar | Employee table</title>
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
                        <h1 class="m-0 text-dark">Employee table</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index.main')}}">Home</a></li>
                            <li class="breadcrumb-item active">Employee table</li>
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

                            <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('employee.update',['id' => $id])}}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Enter employee full name:</label>
                                    <input class="form-control" type="text" name="name" value="{{$employee1->name}}" placeholder="Name..." required>
                                </div>
                                <div class="form-group">
                                    <label for="brand_name">Enter employee email:</label>
                                    <input class="form-control" type="email" name="email" value="{{$employee1->email}}" placeholder="Email address..." required>
                                </div>
                                <div class="form-group">
                                    <label for="brand_name">Enter employee username:</label>
                                    <input class="form-control" type="text" name="user_name" value="{{$employee1->user_name}}" placeholder="Username..." required>
                                </div>
                                <div class="form-group">
                                    <label for="brand_name">Enter employee telephone number:</label>
                                    <input class="form-control" type="text" name="telephone" value="{{$employee1->telephone}}" placeholder="Telephone number..." required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Update</button>
                                <a href="{{route('employee.create')}}" class="btn btn-danger" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;">Back</a>
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
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Telephone</th>
                            <th>Date</th>
                            <th>processing buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        @foreach($employees as $employee)
                            @if($employee->email != session('Mail'))
                                <tr>
                                    <?php $i++;
                                    echo "<td>{$i}</td>"
                                    ?>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->user_name}}</td>
                                    <td>{{$employee->telephone}}</td>
                                    <td>{{$employee->updated_at}}</td>
                                    <td>
                                            <form method="post">
                                                {!! csrf_field() !!}
                                                <a href="{{route('brand.edit', ['id' => $employee->id ])}}" class="btn btn-info" style="margin-right: 5px;margin-bottom: 10px" >Edit</a>
                                            </form>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Telephone</th>
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
