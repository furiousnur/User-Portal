@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Customers</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Customers</a></li>
            </ul>
        </div>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label text-bold">Choose an action</label>
                        <select id="customerChooseAction" name="form_select" class="form-control">
                            <option value="" selected disabled readonly="">Choose an action</option>
                            <option value="add_new_customer">Add new customer</option>
{{--                            <option value="">Reports</option>--}}
                            <option value="business_specific_reports">Business Specific Reports</option>
                            <option value="business_summery_reports">Business Summery Reports</option>
                            <option value="find_a_customer">Find a Customer</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <br>
        {{--   Add New Custommer     --}}
        <div class="row" id="hidden_div_add_new_customer" style="display: none;">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Add Customer</h3>
                    <div class="tile-body">
                        <form method="post" action="{{route('store.customer')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Client Name<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('client_name') is-invalid @enderror" type="text" name="client_name" placeholder="Enter Client Name">
                                        @error('client_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Enter Phone">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Other Info</label>
                                        <input class="form-control @error('other_info') is-invalid @enderror" type="text" name="other_info" placeholder="Enter Other Info">
                                        @error('other_info')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Address<i style="color: red; font-size: 20px;">*</i></label>
                                <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" placeholder="Address">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Submit
                                </button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="{{route('customers')}}"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--   Business Specific Report   --}}
        <div class="row" id="hidden_div_business_reports" style="display: none;">
            <div class="col-md-12">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-bold">Select Business</label>
                                <select id="select_business" name="form_select" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="errorMsg" style="display: none;">
                    <p class="text-danger">Business Not Found</p>
                </div>
                <div class="tile" id="business_table" style="display: none;">
                    <h3 class="tile-title">Business Wise Reports</h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table style="width:100%;border:1px solid black; border-collapse: collapse" id="tblId">
                                    <thead>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Business Name</th>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Total Amount Receivable</th>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Customer(ID)</th>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Customer Accounts Receivable</th>
                                    </thead>
                                    {{--<tr id="business_name_id"></tr>
                                    <tr id="total_amount_receivable"></tr>--}}
                                    <tbody id="b_specific_tableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--   Business Summery Report   --}}
        <div id="errorMsg" style="display: none;">
            <p class="text-danger">Business Summery Not Found</p>
        </div>
        <div class="row" id="hidden_div_business_summery_reports" style="display: none;">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Business Summery Reports</h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table style="width:100%;border:1px solid black; border-collapse: collapse" id="tbl_business_summery">
                                    <thead>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Serial</th>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Business Name</th>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Number of Invoices</th>
                                        <th style="border:1px solid black; border-collapse: collapse; text-align: center;">Customer Accounts Receivable</th>
                                    </thead>
                                    <tbody id="tableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--   Find A Custommer     --}}
        <div class="row" id="hidden_div_find_a_customer" style="display: none;">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">All Customers</h3>
                    <div class="tile-body">
                        <div class="table-responsive">
                            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover table-bordered dataTable no-footer"
                                               id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                                            <thead>
                                            <th>Customer ID</th>
                                            <th>Client Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Other Info</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody>
                                            @if(!empty($customers) && $customers->count())
                                                @foreach($customers as $key=>$customer)
                                                    <tr role="row" class="odd">
                                                        <td>{{$customer->id}}</td>
                                                        <td>{{$customer->client_name}}</td>
                                                        <td>{{$customer->address}}</td>
                                                        <td>{{$customer->phone}}</td>
                                                        <td>{{$customer->email}}</td>
                                                        <td>{{$customer->other_info}}</td>
                                                        <td>{{$customer->status == 1 ? "Active" : "Inactive"}}</td>
                                                        <td>
                                                            <form action="{{route('delete.customer', $customer->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{route('edit.customer',$customer->id)}}" class="btn btn-info">Edit</a>
                                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10">There are no data.</td>
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
        document.getElementById('customerChooseAction').addEventListener('change', function () {
            var style = this.value == "add_new_customer" ? 'block' : 'none';
            document.getElementById('hidden_div_add_new_customer').style.display = style;

            var style = this.value == "find_a_customer" ? 'block' : 'none';
            document.getElementById('hidden_div_find_a_customer').style.display = style;

            var style = this.value == "business_specific_reports" ? 'block' : 'none';
            var bsr = document.getElementById('hidden_div_business_reports').style.display = style;

            // All business Fetch
            if(bsr == 'block'){
                $.ajax({
                    url:"{{url('admin/all-business')}}/",
                    type: "get", //send it through get method
                    data: { },
                    success: function(response) {
                        $("#select_business").empty();
                        $("#select_business").append('<option selected disabled readonly="">Select Business</option>');
                        $.each(response,function(index,value){
                            $("#select_business").append('<option id="businessOption" value="'+value.brand+'">'+value.brand+'</option>');
                            // $("#select_business").append('<option id="businessOption" value="'+value.id+'">'+value.brand+'</option>');
                        });
                    }
                });
            }
            // End All business Fetch
        });
        //Business Specific Reports
        document.getElementById('select_business').addEventListener('change', function () {
            var businessId = document.getElementById('select_business').value;
            $.ajax({
                url:"{{url('admin/business-specific')}}/"+businessId,
                type: "get",
                data: { },
                success: function(response) {
                    if(response == 'Business Not Found.'){
                        document.getElementById('business_table').style.display = 'none';
                        document.getElementById('errorMsg').style.display = 'block';
                        $("#errorMsg").html();
                    }else{
                        document.getElementById('errorMsg').style.display = 'none';
                        document.getElementById('business_table').style.display = 'block';
                        //Data show in table
                        $("#b_specific_tableBody").empty();
                        var total = 0;
                        var rowTr = $("<tr></tr>");
                        rowTr.append('<td style="border:1px solid black; border-collapse: collapse; text-align: center;" rowspan="100">'+response[0].business+'</td>');
                        rowTr.append('<td style="border:1px solid black; border-collapse: collapse; text-align: center;" rowspan="100" id="totalId"></td>');
                        $("#b_specific_tableBody").append(rowTr);
                        $.each(response,function(index,value){
                            total += value.invoice_sum;
                            $("#totalId").html(total);
                            var row = $("<tr></tr>");
                            row.append('<td id="clientName" style="border:1px solid black; border-collapse: collapse; text-align: center;">'+value.customer_id+'</td>');
                            row.append("<td style='border:1px solid black; border-collapse: collapse; text-align: center;'>" + value.invoice_sum + "</td>");
                            $("#b_specific_tableBody").append(row);
                        });
                    }
                }
            });
        });

        //Business Summery Reports
        document.getElementById('customerChooseAction').addEventListener('change', function () {
            var style = this.value == "business_summery_reports" ? 'block' : 'none';
            document.getElementById('hidden_div_business_summery_reports').style.display = style;
            $.ajax({
                url:"{{url('admin/business-summery')}}",
                type: "get",
                data: { },
                success: function(response) {
                    if(response == 'Business Not Found.'){
                        document.getElementById('business_summery_reports').style.display = 'none';
                        document.getElementById('errorMsg').style.display = 'block';
                        $("#errorMsg").html();
                    }else{
                        document.getElementById('errorMsg').style.display = 'none';
                        $("#tableBody").empty();
                        $.each(response,function(index,value){
                            var row = $("<tr></tr>");
                            row.append("<td style='border:1px solid black; border-collapse: collapse; text-align: center;'>" + (index + 1) + "</td>");
                            row.append("<td style='border:1px solid black; border-collapse: collapse; text-align: center;'>" + value.business + "</td>");
                            row.append("<td style='border:1px solid black; border-collapse: collapse; text-align: center;'>" + value.invoice_total + "</td>");
                            row.append("<td style='border:1px solid black; border-collapse: collapse; text-align: center;'>" + value.total_acc_rcvble + "</td>");
                            $("#tbl_business_summery").append(row);
                        });
                    }
                }
            });
        });
    </script>
@endsection
