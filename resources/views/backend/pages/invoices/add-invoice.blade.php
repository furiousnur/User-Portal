@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Add Invoice</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Add Invoice</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Add Invoice</h3>
                    <div class="tile-body">
                        <form method="post" action="{{route('store.invoice')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Type<i style="color: red; font-size: 20px;">*</i></label>
                                        <select name="type" id="" class="form-control @error('type') is-invalid @enderror">
                                            <option value="" selected disabled readonly="">Select One</option>
                                            <option value="new_invoice">New Invoice</option>
                                            <option value="sample_invoice">Sample Invoice</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Invoice Number<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('invoice_number') is-invalid @enderror" type="text" name="invoice_number" placeholder="Enter Invoice Number">
                                        @error('invoice_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Business Name<i style="color: red; font-size: 20px;">*</i></label>
                                        <select name="product_id" id="" class="form-control @error('product_id') is-invalid @enderror">
                                            <option value="" selected disabled readonly="">Select One</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->brand}}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="padding: 3px;">
                                        <div>
                                            <h3><i class="fa fa-user"></i> Customer Information</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Customer Type<i style="color: red; font-size: 20px;">*</i></label>
                                        <select name="customer_type" id="customerChooseAction" class="form-control @error('customer_type') is-invalid @enderror">
                                            <option selected value="walking_client">Walking Client</option>
                                            <option value="regular_client">Regular Client</option>
                                        </select>
                                        @error('customer_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="hidden_div_add_new_customer" style="display: block;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Client Name<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('w_client_name') is-invalid @enderror" type="text" name="w_client_name" placeholder="Enter Client Name">
                                        @error('w_client_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input class="form-control @error('w_phone') is-invalid @enderror" type="text" name="w_phone" placeholder="Enter Phone">
                                        @error('w_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input class="form-control @error('w_email') is-invalid @enderror" type="email" name="w_email" placeholder="Enter Email">
                                        @error('w_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Other Info</label>
                                        <input class="form-control @error('w_other_info') is-invalid @enderror" type="text" name="w_other_info" placeholder="Enter Other Info">
                                        @error('w_other_info')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Address<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('w_address') is-invalid @enderror" name="w_address" type="text" placeholder="Address">
                                        @error('w_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="hidden_div_old_customer" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Enter Customer ID<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" type="text" name="customer_id" placeholder="Enter Customer ID">
                                        <button class="btn btn-primary mt-2" type="submit" id="customerFind"><i class="fa fa-fw fa-lg"></i>Load Client Details </button>
                                        <div id="errorMsg" style="display: none;">
                                            <p class="text-danger">Customer Not Found</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Client Name<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('client_name') is-invalid @enderror" type="text" name="client_name" id="old_c_client_name" placeholder="Enter Client Name">
                                        @error('client_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Client Address<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('address') is-invalid @enderror" name="address" id="old_c_address" type="text" placeholder="Address">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reference No.</label>
                                <input class="form-control @error('reference_no') is-invalid @enderror" name="reference_no" type="text" placeholder="Reference No.">
                                @error('reference_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div style="padding: 3px;">
                                    <div>
                                        <h3><i class="fa fa-add"></i>Add Product to Invoice</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Entry ID</th>
                                        <th>Product Description</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Sub Total</th>
{{--                                        <th>Remove</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" id="productCode" class="form-control" value="">
                                            </td>
                                            <td>
                                                <span id="brand"></span><br>
                                                <span id="lot_number"></span><br>
                                                <span id="model_number"></span><br>
                                                <span id="size"></span>
                                            </td>
                                            <td>
                                                <input type="number" id="qty" name="qty" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" id="unit_price" name="unit_price" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" id="sub_total" readonly name="sub_total" class="form-control">
                                            </td>
                                            {{--<td>
                                                <button type="button" id="removeTable" class="btn btn-danger">Remove</button>
                                            </td>--}}
                                        </tr>
                                    </tbody>
                                </table>
{{--                                <button type="button" id="duplicateTable" class="btn btn-info">Add todo</button>--}}
                                <div id="errorProductMsg" style="display: none;">
                                    <p class="text-danger">Product Not Found</p>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed to Billing</button>
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
        document.getElementById('customerChooseAction').addEventListener('change', function () {
            var style = this.value == "walking_client" ? 'block' : 'none';
            document.getElementById('hidden_div_add_new_customer').style.display = style;

            var style = this.value == "regular_client" ? 'block' : 'none';
            document.getElementById('hidden_div_old_customer').style.display = style;
        });
        $("#duplicateTable").on('click', function (e) {
            e.preventDefault();
            var $self = $(this);
            $self.before($self.prev('table').clone());
        });
        //Regular Customer Find
        $("#customerFind").on('click', function (e) {
            e.preventDefault();
            var customerId = document.getElementById('customer_id').value;
            $.ajax({
                url:"{{url('admin/find-customer')}}/"+customerId,
                type: "get", //send it through get method
                data: { },
                success: function(response) {
                    //Do Something
                    if(response == 'Customer Not Found.'){
                        document.getElementById('errorMsg').style.display = 'block';
                        document.getElementById('old_c_client_name').value = null;
                        document.getElementById('old_c_address').value = null;
                    }else{
                        document.getElementById('errorMsg').style.display = 'none';
                        document.getElementById('old_c_client_name').value = response.client_name;
                        document.getElementById('old_c_address').value = response.address;
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error errorMsg
                }
            });
        });

        //Product Find
        document.getElementById('productCode').addEventListener('change', function () {
            var productCode = document.getElementById('productCode').value;
            $.ajax({
                url:"{{url('admin/find-product')}}/"+productCode,
                type: "get", //send it through get method
                data: { },
                success: function(response) {
                    //Do Something
                    console.log(response);
                    if(response == 'Product Not Found.'){
                        document.getElementById('errorProductMsg').style.display = 'block';
                        $("#brand").html()
                    }else{
                        document.getElementById('errorProductMsg').style.display = 'none';
                        // document.getElementById('brand').p = response.brand;
                        $("#brand").html('Brand: '+response.brand);
                        $("#lot_number").html('Lot No: '+response.lot_number);
                        $("#model_number").html('Model No: '+response.model_number);
                        $("#size").html('Size: '+response.size);
                        $("#qty, #unit_price").on("click input", function() {
                            var qty = document.getElementById('qty').value;
                            var unit_price = document.getElementById('unit_price').value;
                            var total = qty*unit_price;
                            document.getElementById('sub_total').value = total;
                        })
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error errorMsg
                }
            });
        });

        $("#productSearch").on('click', function (e) {
            e.preventDefault();
            var productId = document.getElementById('product_id').value;
            $.ajax({
                url:"{{url('admin/find-customer')}}/"+productId,
                type: "get", //send it through get method
                data: { },
                success: function(response) {
                    //Do Something
                    if(response == 'Customer Not Found.'){
                        document.getElementById('errorMsg').style.display = 'block';
                        document.getElementById('old_c_client_name').value = null;
                        document.getElementById('old_c_address').value = null;
                    }else{
                        document.getElementById('errorMsg').style.display = 'none';
                        document.getElementById('old_c_client_name').value = response.client_name;
                        document.getElementById('old_c_address').value = response.address;
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error errorMsg
                }
            });
        });
    </script>
@endsection
