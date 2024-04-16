@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Login') }}</div>
                    <div class="card-body">
                        <h2>Bit Mascot</h2>
                        <p>To authenticate, please use the following Ont Time Password (OTP): <strong>{{ $otp }}</strong>.</p>
                        <p>Don't share this OTP with anyone. we hope to see you again soon.</p>
                        <br>
                        <p>Regards,</p>
                        <p>Bit Mascot</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
