@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Users</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Users</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Users Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover table-bordered dataTable no-footer"
                                               id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            @foreach ($data as $key => $user)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if(!empty($user->getRoleNames()))
                                                            @foreach($user->getRoleNames() as $v)
                                                                <label class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! $data->render() !!}
    </main>
@endsection
