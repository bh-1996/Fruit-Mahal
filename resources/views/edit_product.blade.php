@extends('layouts.guest')
@section('content')
@include('flash-message')
<style>
h6{
color: black;
}
.text-secondary{
    font-size: 1.3rem;
    color: rgb(194, 10, 25)!important;
}
</style>
{!! Toastr::message() !!}
	<!-- blog section -->

	  <section class="blog_section layout_padding2-top layout_padding-bottom">
	    <div class="container">
	      <div class="heading_container">
	        <h2>
	          Edit Product
	        </h2>
	      </div>
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

			<div class="col-lg-8">
				<div class="white-background box">
					<div class="card mb-3">
						<form action="{{ route('product.update',$product['id']) }}" method="post" class="myform" enctype="multipart/form-data">
                            @csrf
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Product Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="title" value="{{ $product->title }}">
                                    @if ($errors->has('title'))
                                    <span style="color: red">{{ $errors->first('title') }}</span>
                                    @endif
								</div>
							</div>
							<hr>
							<div class="row">
		                    <div class="col-sm-3">
		                      <h6 class="mb-0">Description</h6>
		                    </div>
		                    <div class="col-sm-9 text-secondary">
		                      <span><input type="text" class="form-control" name="description" value="{{ $product->description }}"></span>
                              @if ($errors->has('description'))
                              <span style="color: red">{{ $errors->first('description') }}</span>
                              @endif
                            </div>
		                  </div>
		                  <hr>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Price</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                    @if ($errors->has('price'))
                                    <span style="color: red">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
							</div>
							<hr>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Image</h6>
								</div>
                                <div>
                                    <img id="preview-image-before-upload" src="/images/default-image-file.png"
                                        alt="preview image" class="preview">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="image" id="image">
                                </div>
							</div>
							<hr>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-info px-4" value="Update">
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


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
