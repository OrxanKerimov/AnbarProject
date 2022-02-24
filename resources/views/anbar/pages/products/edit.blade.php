@extends('anbar.layouts.layout')

@section('active5')
    active
@endsection

@section('title')
    <title>Anbar | Products table</title>
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
                        <h1 class="m-0 text-dark">Products table</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index.main')}}">Home</a></li>
                            <li class="breadcrumb-item active">Products table</li>
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
                    <form class="was-validated" method="post" enctype="multipart/form-data" action="{{route('product.update',['id' => $id])}}">
                        @csrf
                        <div class="form-group">
                            <label for="brand_id">Update brand name:</label>
                            <select class="form-control" name="brand_id" required>
                                <option value="{{$product1->brand_id}}">{{$product1->brand->brand_name}}</option>
                                @foreach($brands as $brand)
                                    @if($brand->id !=$product1->brand_id)
                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Update product name:</label>
                            <input type="text" class="form-control" value="{{$product1->name}}"  name="product_name" placeholder="..." required >
                        </div>
                        <div class="custom-file form-group"  >
                            <input type="file" class="custom-file-input" name="product_photo" >
                            <label class="custom-file-label" for="product_photo">Choose the new product photo...</label>
                        </div>
                        <div class="form-group" style="margin-top: 15px;">
                            <label for="amount">Update quantity of product</label>
                            <input type="number" value="{{$product1->amount}}" class="form-control" name="amount" placeholder="..." required >
                        </div>
                        <div class="form-group">
                            <label for="buy">Update the prime cost of goods($)</label>
                            <input type="number" value="{{$product1->buy}}" class="form-control" name="buy" placeholder="..." required >
                        </div>
                        <div class="form-group">
                            <label for="sell">Update the selling price of goods($)</label>
                            <input type="number" value="{{$product1->sell}}" class="form-control" name="sell" placeholder="..." required >
                        </div>
                        <button type="submit" name="add" class="btn btn-primary" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;" >Update</button>
                        <a href="{{route('product.create')}}" class="btn btn-danger" style="margin-top: 10px; margin-left: auto; margin-bottom: 30px;">Back</a>
                    </form>
                    </div>
                    <div class="col-4">
                        <img src="{{asset('storage/'.$product1->photo)}}" style="width:100px; height:70px; margin-top:130px; margin-left: 20px;">
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
                            <th>Product name</th>
                            <th>Product photo</th>
                            <th>amount of goods</th>
                            <th>prime cost($)</th>
                            <th>selling price($)</th>
                            <th>Date</th>
                            <th>processing buttons</th>
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
                                <td>
                                    <form method="post">
                                        {!! csrf_field() !!}
                                        <a href="{{route('product.edit', ['id' => $product->id ])}}" class="btn btn-info" style="margin-right: 10px;margin-bottom: 10px" >Edit</a>
                                    </form>
                                </td>
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

