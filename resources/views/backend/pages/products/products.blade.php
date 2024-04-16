@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Products</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Search Products</h3>
                    <div class="tile-body">
                        <form method="get" action="{{route('products.searching')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Principle Name</label>
                                        <select class="form-control" name="brand">
                                            <option value="" selected disabled>Choose Principle Name</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->brand}}">{{$brand->brand}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Product Code</label>
                                        <select class="form-control" name="product_code">
                                            <option value="" selected disabled>Choose Product Code</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->product_code}}">{{$product->product_code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Product Entry From Date</label>
                                        <input class="form-control" id="fromDate" name="entry_date_from_date" type="text" placeholder="Enter From Date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Product Entry To Date</label>
                                        <input class="form-control" id="toDate" name="entry_date_to_date" type="text" placeholder="Enter To Date">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="all_principle_list" value="1"><span style="font-size: 16px;">All Principle List</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-fw fa-lg fa-check-circle"></i>Generate Report
                                    </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('products')}}"><i
                                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Products</h3>
                    <div class="tile-body">
                        <div class="table-responsive">
                            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover table-bordered dataTable no-footer"
                                               id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                                            <thead>
                                            <th>Product Code</th>
                                            <th>Brand</th>
                                            <th>Lot No.</th>
                                            <th>Model No.</th>
                                            <th>Serial No.</th>
                                            <th>Entry Date</th>
                                            <th>Qty</th>
                                            <th>Size</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody>
                                            @if(!empty($searchingProducts) && $searchingProducts->count()>0)
                                                @foreach($searchingProducts as $key=>$product)
                                                    <tr role="row" class="odd">
                                                        <td>{{$product->product_code}}</td>
                                                        <td>{{$product->brand}}</td>
                                                        <td>{{$product->lot_number}}</td>
                                                        <td>{{$product->model_number}}</td>
                                                        <td>{{$product->serial_number}}</td>
                                                        <td>{{$product->entry_date}}</td>
                                                        <td>{{$product->qty}}</td>
                                                        <td>{{$product->size}}</td>
                                                        <td>
                                                            <form action="{{route('delete.product', $product->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{route('qrCode.product',$product->id)}}" target="_blank" class="btn btn-success">Qr Code</a>
                                                                <a href="{{route('edit.product',$product->id)}}" class="btn btn-info">Edit</a>
                                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
{{--                                                    <td colspan="10">There are no data.</td>--}}
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
@endsection
@section('extra-script-link')
    <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/select2.min.js')}}"></script>
    <script type="text/javascript">
        $('#fromDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });
        $('#toDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

        $('#demoSelect').select2();
    </script>
@endsection
