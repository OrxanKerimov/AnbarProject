@extends('anbar.layouts.layout')

@section('title')
    <title>Anbar | Home</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/main/index/css/database.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Home</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$brands->count()}}</h3>
                                <p>Brands</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$products->count()}}</h3>

                                <p>Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$clients->count()}}</h3>

                                <p>Clients</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$orders->count()}}</h3>

                                <p>Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Brands table</h4>
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
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Brand name</th>
                                        <th>Logo photo</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Clients table</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Full name</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Company </th>
                                        <th>Date</th>
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
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Full name</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Products table</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Brand name</th>
                                <th>Product name</th>
                                <th>Product photo</th>
                                <th>amount of goods</th>
                                <th>prime cost($)</th>
                                <th>selling price($)</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0 ?>
                            @foreach($products as $product)
                                <tr>
                                    <?php $i++;
                                    echo "<td>{$i}</td>"
                                    ?>
                                    <td>{{$product->brand->brand_name}}</td>
                                    <td>{{$product->name}}</td>
                                    <td><img style="width:100px; height:70px;" src="{{asset('storage/'.$product->photo)}}"></td>
                                    <td>{{$product->amount}}</td>
                                    <td>{{$product->buy}} $</td>
                                    <td>{{$product->sell}} $</td>
                                    <td>{{$product->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Brand name</th>
                                <th>Product name</th>
                                <th>Product photo</th>
                                <th>amount of goods</th>
                                <th>prime cost($)</th>
                                <th>selling price($)</th>
                                <th>Date</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4"> <h4>Orders table</h4></div>
                            <div class="col-8" >
                                <span class="alert alert-warning" style="width: auto;">
                                Total orders:{{$r1}}
                                </span>
                                    <span class="alert alert-warning" style="margin-left: 5px;width: auto; height: auto;">
                                confirmed orders:{{$r2->count()}}
                                </span>
                                    <span class="alert alert-warning" style="margin-left: 5px;width: 100%;">
                                pending orders:{{$r3->count()}}
                                </span>
                                    <span class="alert alert-warning" style="margin-left: 5px;width: 100%;">
                                goods sold:{{$amount}}
                                </span>
                                    <span class="alert alert-warning" style="margin-left: 5px;width: 100%;">
                                profit:{{$profit}}
                                </span>
                                    <span class="alert alert-warning" style="margin-left: 5px;width: 100%;">
                                profit pending:{{$profit1}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Client full name</th>
                                <th>Product name</th>
                                <th>Total amount of goods</th>
                                <th>Amount of goods</th>
                                <th>Profit($)</th>
                                <th>Date</th>
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
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')


    <script src="{{asset('assets/main/index/js/database.js')}}"></script>
    <script>
    $(function () {
    $("#example1").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
        $(function () {
            $("#example3").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(function () {
            $("#example2").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(function () {
            $("#example4").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
            }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
