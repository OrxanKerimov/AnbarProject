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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('order.update', ['id' => $order1->id])}}">
                                @csrf
                                <div class="form-group">
                                    <label for="client_id">Enter client name:</label>
                                    <select class="form-control" name="client_id" required>
                                        <option value="{{$order1->client_id}}">{{$order1->client->name}}</option>
                                        @foreach($clients as $client)
                                            @if($client->id != $order1->client_id)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_id">Enter product name:</label>
                                    <select class="form-control" name="product_id" required>
                                        <option value="{{$order1->product_id}}">{{$order1->product->brand->brand_name}} — {{$order1->product->name}}</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->brand->brand_name}} — {{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Enter quantity of product:</label>
                                    <input type="text" class="form-control" name="amount" placeholder="..." value="{{$order1->amount}}" required >
                                </div>
                                <button type="submit" name="add" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Update</button>
                                <a href="{{route('order.create')}}" class="btn btn-danger" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;">Back</a>                            </form>
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
                                        <a href="{{route('order.edit', ['id' => $order->id ])}}" class="btn btn-info" style="margin-right: 10px;margin-bottom: 10px" >Edit</a>
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

