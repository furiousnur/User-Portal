@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-md-center"><h2>{{ __('Verification Code') }}</h2></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="text-md-center">{{ __('An unique code has been sent to your email') }}</p>
                        <form method="POST" action="{{ route('otp.verify.post') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="otp" class="col-md-4 col-form-label text-md-end">{{ __('Verification Cde') }}</label>
                                <div class="col-md-6">
                                    <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" required placeholder="123456">
                                    @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input id="otp" type="hidden" class="form-control" name="email" value="{{$email ?? ''}}">
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verify OTP & Login') }}
                                    </button>
                                </div>
                            </div>
                            <div class="text-md-center mt-2">{{ __("Don't have an account?") }} <a href="{{route('register')}}">Sign Up</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
