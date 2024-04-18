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
                    <h2>Users List</h2>
                </div>
                <div class="pull-right">
                    <input type="text" class="form-controller" id="search" name="search" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover table-bordered dataTable no-footer"
                                               id="userTable" role="grid" aria-describedby="userTable_info">
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Date Of Birth</th>
                                                <th>Id Verification</th>
                                                <th>Roles</th>
                                                @can('set-role')
                                                    <th>Action</th>
                                                @endcan
                                            </tr>
                                            @foreach ($data as $key => $user)
                                                <tr>
                                                    <td>{{ $user->first_name }} {{$user->last_name}}</td>
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->date_of_birth }}</td>
                                                    <td><img width="100" height="120" src="{{ asset('uploads/' . $user->id_verification) }}" alt=""></td>
                                                    <td>
                                                        @if(!empty($user->getRoleNames()))
                                                            @foreach($user->getRoleNames() as $v)
                                                                <label class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    @can('set-role')
                                                        <td>
                                                            <a class="btn btn-info" href="{{ route('users.edit',$user->id) }}">Set Role</a>
                                                        </td>
                                                    @endcan
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
@section("extra-script-link")
   <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var data = $(this).val();
                $.ajax({
                    url: "{{ route('users.search') }}",
                    type: "GET",
                    dataType:'html',
                    headers:{
                        'accept':"Application/json",
                        'content-type':"Application/json"
                    },
                    data: { searchKeywords: data },
                    success: function(response) {
                        $('#userTable tbody').empty();
                        $('#userTable tbody').html($(response).find('#userTable tbody').html());
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
