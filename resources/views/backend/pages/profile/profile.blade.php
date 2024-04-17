@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Profile Details</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Profile Details</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="card mt-5">
                                    <div class="card-header">
                                        <h3>Profile Details</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-4 col-form-label">First Name:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="first_name" value="{{ $user->first_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-4 col-form-label">Last Name:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="last_name" value="{{ $user->last_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-4 col-form-label">Phone:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-4 col-form-label">Address:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="address" value="{{ $user->address }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label">Email:</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dob" class="col-sm-4 col-form-label">Date of Birth:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="dob" value="{{ $user->date_of_birth->format('Y-m-d') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dob" class="col-sm-4 col-form-label">Id Verification:</label>
                                            <div class="col-sm-8">
                                                <img width="100" height="120" src="{{ asset('uploads/' . $user->id_verification) }}" alt="">
                                            </div>
                                        </div>
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
