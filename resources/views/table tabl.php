@extends("layouts.guest")
@section('content')
    @include('flash-message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h1 style="text-align: center">Show Product List </h1><br>
                        <div class="card-header">
                            <h3 class="card-title">About Products</h3>
                            <a href="{{ route('product.page') }}" class="add-btn"><button type="button"
                                    class="btn btn-info" style="margin-left: 78%;">Add Product</button></a>
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Price / Rate per /kg</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td>{{ $row->price }}</td>
                                            <td>
                                                <img src="{{ asset('product_img/' . $row->image) }}"
                                                    alt="{{ $row->image }}" width="100px" height="80px">
                                            </td>
                                            <td onclick="return confirm('Are you sure.? Do you want to change.!');">
                                                <input data-id="{{ $row->id }}" class="toggle-class active_inactive"
                                                    type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                    data-toggle="toggle" data-on="Active" data-off="InActive"
                                                    {{ $row->status ? 'checked' : '' }}>
                                            </td>
                                            <td><a href="{{ route('product.edit', $row->id) }}"
                                                    class="btn btn-warning">Edit</a></td>
                                            <td><a href="{{ route('product.delete', $row->id) }}"
                                                    class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript ">

        $(function() {
                // alert();
                $(document).ready( function () {
                    $('#myTable').DataTable();
                } );
            $('.active_inactive').on('change', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');
                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '/productstatus',
                    data: {
                        'status': status,
                        'user_id': user_id,
                        '_token': token
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })

        $('#data_table').DataTable();

    </script>

@endsection

@endsection
