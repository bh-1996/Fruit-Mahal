@extends('layouts.guest')
@section('content')
@include('flash-message')
{!! Toastr::message() !!}
<div style="text-align:center; margin-top:2%; font-size:2rem">
    <h1>
      My Cart
    </h1>
    ================
  </div>
  <section>
    <table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:20%">Product</th>
            <th style="width:10%">Rate</th>
            <th style="width:8%">Quantity / Kg</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div>
                            <div><img src="{{'product_img/'.$details['image'] }}" width="100" height="100" class="img-responsive"/></div>

                        </div>
                    </td>
                    <td data-th="Price">Rs: {{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">Rs: {{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                        <button class="btn btn-dark btn-sm update-cart"><i class="fa fa-repeat"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total Rs: {{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <a href="{{ route('deliveryDetails') }}"><button class="btn btn-success">Checkout</button></a>
            </td>
        </tr>
    </tfoot>
</table>
  </section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>



<script type="text/javascript">
    {{--  confirm("Are you sure want to remove?");  --}}
    $(document).ready(function () {
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);

        $.ajax({

            url: '{{ route('updateQuantity') }}',
            method: "post",
            data: {

                _token: '{{ csrf_token() }}',

                id: ele.parents("tr").attr("data-id"),

                quantity: ele.parents("tr").find(".quantity").val()

            },

            success: function (response) {

               window.location.reload();

            }

        });

    });

    $(".remove-from-cart").click(function (e) {

        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {

            $.ajax({

                url: '{{ route('removeItem') }}',

                method: "DELETE",

                data: {

                    _token: '{{ csrf_token() }}',

                    id: ele.parents("tr").attr("data-id")

                },

                success: function (response) {

                    window.location.reload();

                }

            });

        }

    });
});

</script>
