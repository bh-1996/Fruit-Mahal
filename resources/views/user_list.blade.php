@extends("layouts.guest")
@section('content')
 @include('flash-message')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                        <h1 style="text-align: center">Show User List </h1><br>
                        <div class="card-header">
                            <h3 class="card-title">About Users</h3>
                            <a href="{{ route('signup.post') }}" class="add-btn"><button type="button" class="btn btn-info" style="margin-left: 78%;">Add Product</button></a>
                        </div>
                        <div class="card-body">
                        <table id="data_table" class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Class</th>
                            <th>Address</th>
                            <th>Subject</th>
                            <th>Image</th>
                            <th colspan="3">Action</th>
                        </tr>

                        @foreach ($user as $row )

                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->user_type }}</td>
                            <td>{{ $row->full_name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->class }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->subject }}</td>
                            <td>
                                <img src="{{ asset('addimage/'.$row->images) }}" alt="{{ $row->images }}" width="100px" height="80px">
                            </td>
                            <td><a href="{{ route('profile.post',$row->id) }}" class="btn btn-success">View</a></td>
                            <td><a href="{{ route('profileedit.post',$row->id) }}" class="btn btn-warning">Edit</a></td>
                            <td><a href="{{ route('delete.post',$row->id) }}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
                {{-- // <div style="text-align: center"><a href="{{ route('logout.post') }}" class="btn btn-danger">Logout User</a></div> --}}

@endsection
