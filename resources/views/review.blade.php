@extends('layouts.guest')
@section('content')
@include('flash-message')

    <div class="registration-form">
        <form action="{{ route('product.add') }}" class="myform" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 mb-2">
                <img id="preview-image-before-upload" src="images/default-image-file.png"
                    alt="preview image" style="margin-left: 30%;" class="preview">
            </div>
            <div class="form-group" style="margin-left: 35%;">
                <input type="file" name="image" placeholder="Choose image" id="image">
            </div>

            <div class="form-group">
                <input type="text" name="title" class="form-control item" placeholder="Product Title" value="{{ old('title') }}">
            </div>

             <div class="form-group">
                <input type="varchar" name="description" class="form-control item" placeholder="Product description" value="{{ old('description') }}">

            </div>
            <div class="form-group">
                <input type="text" name="price" class="form-control item"  placeholder="price" value="{{ old('price') }}">
            </div>


            <div class="form-group">
                <button  type="submit" class="btn btn-block create-account">Add Product</button>
            </div>
            <div class="social-media">
                <h5>Show product list<a href="{{ route('product.list') }}"> Product list</a></h5>
            </div>
        </form>
    </div>

    @section('script')
    <script type="text/javascript">

        $(document).ready(function (e) {


           $('#image').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

              $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

           });

        });

        </script>
        @endsection
     @endsection
