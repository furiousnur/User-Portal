@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Edit Product</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{route('products')}}">Products</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Edit Product</h3>
                    <div class="tile-body">
                        <form method="post" action="{{route('update.product',$product->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Brand<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('brand') is-invalid @enderror" type="text" name="brand" value="{{$product->brand}}">
                                        @error('brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Lot Number</label>
                                        <input class="form-control @error('lot_number') is-invalid @enderror" type="text" name="lot_number" value="{{$product->lot_number}}">
                                        @error('lot_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Model Number<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('model_number') is-invalid @enderror" type="text" name="model_number" value="{{$product->model_number}}">
                                        @error('model_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Serial Number</label>
                                        <input class="form-control @error('serial_number') is-invalid @enderror" type="text" name="serial_number" value="{{$product->serial_number}}">
                                        @error('serial_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Quantity<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('qty') is-invalid @enderror" type="text" name="qty" value="{{$product->qty}}">
                                        @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Size</label>
                                        <input class="form-control @error('size') is-invalid @enderror" type="text" name="size" value="{{$product->size}}">
                                        @error('size')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label class="control-label">Entry Date<i style="color: red; font-size: 20px;">*</i></label>
                                <input class="form-control @error('entry_date') is-invalid @enderror" id="demoDate" name="entry_date" type="text" value="{{$product->entry_date}}">
                                @error('entry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>--}}
                            <div class="form-group">
                                <label class="control-label">Description<i style="color: red; font-size: 20px;">*</i></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description" placeholder="Enter Description">{!! $product->description !!}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('products')}}"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                            </div>
                        </form>
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
        $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

        $('#demoSelect').select2();
    </script>
@endsection
