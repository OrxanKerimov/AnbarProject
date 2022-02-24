@extends('anbar.layouts.layout')

@section('active7')
    active
@endsection

@section('title')
    <title>Anbar | Orders table</title>
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
                        <h1 class="m-0 text-dark">Orders table</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index.main')}}">Home</a></li>
                            <li class="breadcrumb-item active">Orders table</li>
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

                        @if(session('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
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
                        <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('order.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="client_id">Enter client name:</label>
                                <select class="form-control" name="client_id" required>
                                    <option value="">...</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Enter product name:</label>
                                <select class="form-control" name="product_id" required>
                                    <option value="">...</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->brand->brand_name}} — {{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Enter quantity of product:</label>
                                <input type="text" class="form-control" name="amount" placeholder="..." required >
                            </div>
                            <button type="submit" name="add" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Add</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="alert alert-warning">
                    Total orders: {{$r1}}
                    </span>
                    <span class="alert alert-warning" style="margin-left: 5px;">
                    confirmed orders: {{$r2->count()}}
                    </span>
                    <span class="alert alert-warning" style="margin-left: 5px;">
                    pending orders: {{$r3->count()}}
                    </span>
                    <span class="alert alert-warning" style="margin-left: 5px;">
                    goods sold: {{$amount}}
                    </span>
                    <span class="alert alert-warning" style="margin-left: 5px;">
                    profit: {{$profit}}
                    </span>
                    <span class="alert alert-warning" style="margin-left: 5px;">
                    profit pending: {{$profit1}}
                    </span>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Client full name</th>
                            <th>Product name</th>
                            <th>Total amount of goods</th>
                            <th>Amount of goods</th>
                            <th>Profit($)</th>
                            <th>Date</th>
                            <th>processing buttons</th>
                        </tr>
                        </thead>
                        <?php $i = 0 ?>
                    @foreach($orders as $order)
                        @if($order->confirmation == 1)
                            <tbody style="background-color: green">
                            @else
                            <tbody style="background-color: yellow">
                                @endif

                            @php
                               $profit = ($order->product->sell - $order->product->buy)*$order->amount;
                            @endphp
                            <tr>
                                <?php $i++;
                                echo "<td>{$i}</td>"
                                ?>
                                <td>{{$order->client->name}}</td>
                                <td>{{$order->product->name}} — {{$order->product->brand->brand_name}}</td>
                                <td>{{$order->product->amount}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{$profit}} $</td>
                                <td>{{$product->updated_at}}</td>
                                <td>
                                    <form method="post">
                                        {!! csrf_field() !!}
                                        @if($order->confirmation == 0)
                                        <a type="submit" href="{{route('order.confirmation', ['id' => $order->id])}}"   class="btn btn-success btn" style="margin-right: 5px; margin-bottom: 10px">
                                            Confirm
                                        </a>
                                        <a href="{{route('order.edit', ['id' => $order->id ])}}" class="btn btn-info" style="margin-right: 5px;margin-bottom: 10px" >Edit</a>
                                        <button type="button" class=" btn btn-danger" data-toggle="modal" data-target="#deleteModal" style="margin-right: 5px;margin-bottom: 10px" data-whatever="{{$order->product->name}} — {{$order->product->brand->brand_name}}" data-whatever1="{{$order->id}}">
                                            Delete
                                        </button>
                                        @else
                                            <a type="submit" href="{{route('order.cancellation', ['id' => $order->id])}}"  class="btn btn-danger btn" style="margin-right: 5px; margin-bottom: 10px">
                                               Cancel
                                            </a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                                @endforeach
                                <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Client full name</th>
                            <th>Product name</th>
                            <th>Total amount of goods</th>
                            <th>Amount of goods</th>
                            <th>Profit($)</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{route('order.delete',['id' => 'delete'])}}">
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
            modal.find('.modal-body').text('Do you really want to remove this order "'+recipient+'"?');
            $("#for_button").click(function() {
                $.ajax({
                    type:'POST',
                    url:"http://ambar/orders/"+ id,
                    data:{ 'order_id' : recipient },
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

