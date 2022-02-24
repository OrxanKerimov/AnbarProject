@extends('anbar.layouts.layout')

@section('active6')
    active
@endsection

@section('title')
    <title>Anbar | Clients table</title>
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
                        <h1 class="m-0 text-dark">Clients table</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index.main')}}">Home</a></li>
                            <li class="breadcrumb-item active">Clients table</li>
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
                            <form class="was-validated" method="post" action="{{route('client.update',['id' => $id])}}">
                                @csrf
                                <div class="form-group">
                                    <label for="client_name">Update the client's full name:</label>
                                    <input type="text" class="form-control" value="{{$client1->name}}" name="name" placeholder="..." required >
                                </div>
                                <div class="form-group" style="margin-top: 15px;">
                                    <label for="telephone">Update client phone number:</label>
                                    <input type="number" class="form-control" value="{{$client1->telephone}}" name="telephone" placeholder="..." required >
                                </div>
                                <div class="form-group">
                                    <label for="email">Update client email:</label>
                                    <input type="email" class="form-control" name="email" value="{{$client1->email}}" placeholder="..." required >
                                </div>
                                <div class="form-group">
                                    <label for="company">Update client company</label>
                                    <input type="text" class="form-control" name="company" value="{{$client1->company}}" placeholder="..." required >
                                </div>
                                <button type="submit" name="add" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Update</button>
                                <a href="{{route('client.create')}}" class="btn btn-danger" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;">Back</a>
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
                            <th>Client full name</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Company name</th>
                            <th>Date</th>
                            <th>processing buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        @foreach($clients as $client)
                            <tr>
                                <?php $i++;
                                echo "<td>{$i}</td>"
                                ?>
                                <td>{{$client->name}}</td>
                                <td>{{$client->telephone}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->company}}</td>
                                <td>{{$client->updated_at}}</td>
                                <td>
                                    <form method="post">
                                        {!! csrf_field() !!}
                                        <a href="{{route('client.edit', ['id' => $client->id ])}}" class="btn btn-info" style="margin-right: 10px;margin-bottom: 10px" >Edit</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Client full name</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Company name</th>
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

