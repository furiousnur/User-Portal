@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Login') }}</div>
                    <div class="card-body">
                        <p>Hello,</p>
                        <p>Your login verification OTP is <strong>{{ $otp }}</strong>.</p>
                        <p>Please use this OTP to complete the login process.</p>
                        <p>If you did not request this OTP, please disregard this email.</p>
                        <p>Thank you!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
