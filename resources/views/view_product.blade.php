@extends('layouts.guest')
@section('content')
@include('flash-message')
<style>
h6{
color: black;
}
</style>
  <!-- blog section -->
  {!! Toastr::message() !!}
  <section class="blog_section layout_padding2-top layout_padding-bottom">
    <div class="container">
      <div class="heading_container">
        <h2>
          Product Details
        </h2>
      </div>
      <a href="{{ route('products') }}" class="btn btn-primary">Products</a>
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="img-box">
                <img src="{{ asset('product_img/'.$product->image) }}" alt="{{ $product->image }}">
            </div>
            <div class="detail-box">
              <h2>
                <span>{{ $product->title }}</span>
              </h2>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="white-background box">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Product Name : </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ $product->title }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Description : </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span>{{$product->description }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Rate : </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span>{{ $product->price }} / 1 kg</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Review : </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span class="rating" style="color: orange">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </span>
                    </div>
                  </div>
                  <hr>
                    <div class="col-sm-12">
                        <a class="btn btn-danger " href="{{ route('add.to.cart',$product->id) }}">Add to cart</a>
                      </div>
                  </div>
                </div>
              </div>
              </div>
            </div>

      </div>
    </div>
  </section>

  <!-- end blog section -->

  @endsection
