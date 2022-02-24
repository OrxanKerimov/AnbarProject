@extends('anbar.layouts.layout')

@section('active3')
    active
@endsection

@section('title')
    <title>Anbar | Employees table</title>
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
                            <li class="breadcrumb-item active">Employees table</li>
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
                        <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('employee.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Enter employee full name:</label>
                                <input class="form-control" type="text" name="name" placeholder="Name..." required>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Enter employee email:</label>
                                <input class="form-control" type="email" name="email" placeholder="Email address..." required>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Enter employee username:</label>
                                <input class="form-control" type="text" name="user_name" placeholder="Username..." required>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Enter employee telephone number:</label>
                                <input class="form-control" type="text" name="telephone" placeholder="Telephone number..." required>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Enter employee password:</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="*************" required>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Repeat employee password:</label>
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="*************" required>
                            </div>
                            <button type="submit" name="add" class="btn btn-primary" style="margin-top: 10px; margin-left: auto;" >Registration</button>
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
                                    @if($employee->accept == 1)
                                        <a type="submit" href="{{route('employee.accept', ['id' => $employee->id])}}"  class="btn btn-success btn-sm" style="margin-right: 5px; margin-bottom: 10px">Accept</a>
                                    @elseif($employee->block == 1)
                                        <a type="submit" href="{{route('employee.unlock', ['id' => $employee->id])}}"  class="btn btn-danger btn-sm" style="margin-right: 5px; margin-bottom: 10px">Unlock</a>
                                    @else
                                    <form method="post">
                                        {!! csrf_field() !!}
                                        <a href="{{route('employee.edit', ['id' => $employee->id ])}}" class="btn btn-info" style="margin-right: 5px;margin-bottom: 10px" >Edit</a>
                                        <button type="button" class=" btn btn-danger" value="{{$employee->name}}" data-toggle="modal" data-target="#deleteModal" style="margin-right: 5px;margin-bottom: 10px" data-whatever="{{$employee->name}}" data-whatever1="{{$employee->id}}">
                                            Delete
                                        </button>
                                        <a href="{{route('employee.block', ['id' => $employee->id ])}}" class="btn btn-warning" style="margin-right: 5px;margin-bottom: 10px" >Block</a>
                                    </form>
                                    @endif
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{route('employee.delete',['id' => 'delete'])}}">
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
            modal.find('.modal-body').text('Do you really want to remove the employee "' + recipient + '"?');
            $("#for_button").click(function() {
                $.ajax({
                    type:'POST',
                    url:"http://ambar/employees/"+ id,
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


