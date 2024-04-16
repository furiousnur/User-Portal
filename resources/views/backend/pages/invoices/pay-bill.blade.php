@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Pay Invoice Bill</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Pay Invoice Bill</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Pay Invoice Bill</h3>
                    <div class="tile-body">
                        <form method="post" action="{{route('update.invoice.bill', $invoice->id)}}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Payable Amount<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('payable_amount') is-invalid @enderror" id="payable_amount" readonly type="number" name="payable_amount" value="{{$invoice->due}}">
                                        @error('payable_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Amount<i style="color: red; font-size: 20px;">*</i></label>
                                        <input class="form-control @error('pay_amount') is-invalid @enderror" type="number" id="pay_amount" name="pay_amount" value="">
                                        @error('pay_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" id="submitButton" disabled type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
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
        $(document).ready(function() {
            $('#pay_amount').on('keyup', function() {
                var payable_amount = parseFloat($('#payable_amount').val());
                var pay_amount = parseFloat($('#pay_amount').val());
                if (!isNaN(pay_amount) && pay_amount <= payable_amount) {
                    $('#submitButton').prop('disabled', false);
                } else {
                    alert('amount can be less than payable amount or equal');
                    $('#submitButton').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
