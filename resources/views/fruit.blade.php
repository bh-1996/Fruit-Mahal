@extends("layouts.guest")
@section('content')

  <!-- product section -->

  <section class="product_section layout_padding2-top layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Fruits
        </h2>
        <p>
          which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't an
        </p>
      </div>

      <div class="row">
        @foreach ($product as $fruit )
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <a href="{{ route('fruit.mahal') }}"><img src="{{ asset('product_img/' . $fruit->image) }}" alt="$fruit->image"></a>
            </div>
            <div class="detail-box">
                <h2>
                  Upto 60% Off
                </h2>
              </div>
            <div class="detail-box">
              <span class="rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-half-o" aria-hidden="true"></i>
              </span>
              <a href="">
                {{ $fruit->title }}
              </a>
              {{-- <p>{{ $fruit->status }}</p> --}}
              <div class="price_box">
                <h6 class="price_heading">
                  <span>Rs : </span>{{ $fruit->price }}/ 1 kg
                </h6>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        </div>
        <div class="paginator">
            {{ $product->links() }}
        </div>
      </div>
      <div class="btn-box">
        <a href="{{ route('fruit.mahal') }}">
          View All
        </a>
      </div>

  </section>

  <!-- end product section -->



 @endsection

