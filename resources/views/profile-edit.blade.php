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

	<!-- blog section -->

	  <section class="blog_section layout_padding2-top layout_padding-bottom">
	    <div class="container">
	      <div class="heading_container">
	        <h2>
	          Edit My Profile
	        </h2>
	      </div>
	      <div class="row">
	        <div class="col-md-4">
	          <div class="box">
	            <div class="img-box">
                    <img src="{{ asset('addimage/'.$user->images) }}" alt="{{ $user->images }}">
	            </div>
	            <div class="detail-box">
	              <h2>
                    <span>{{ $user->full_name }}</span>
	              </h2>
	            </div>
	          </div>
	        </div>

			<div class="col-lg-8">
				<div class="white-background box">
					<div class="card mb-3">
						<form action="{{ route('update.post',$user['id']) }}" method="post" enctype="multipart/form-data">
                            @csrf
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="full_name" value="{{ $user->full_name }}">
								</div>
							</div>
							<hr>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="email" value="{{ $user->email }}">
								</div>
							</div>
							<hr>

							<div class="row">
		                    <div class="col-sm-3">
		                      <h6 class="mb-0">Class</h6>
		                    </div>
		                    <div class="col-sm-9 text-secondary">
		                      <span><input type="text" class="form-control" name="class" value="{{ $user->class }}"></span>
		                    </div>
		                  </div>
		                  <hr>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Subject</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="subject" value="{{ $user->subject }}">
								</div>
							</div>
							<hr>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="address" class="form-control" value="{{ $user->address }}">
								</div>
							</div>
							<hr>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Country</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="country" class="form-control" value="{{ $user->country }}">
								</div>
							</div>
							<hr>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">State</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="state" class="form-control" value="{{ $user->state }}">
								</div>
							</div>
							<hr>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Pin Code</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="zip_code" class="form-control" value="{{ $user->zip_code }}">
								</div>
							</div>
							<hr>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Image</h6>
								</div>
								{{--  <div class="col-sm-9 text-secondary">
									<input type="file" name="images" value="{{ $user->images }}">
								</div>  --}}
                                <div>
                                    <img id="preview-image-before-upload" src="/images/default-image.png"
                                        alt="preview image" class="preview">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="images" id="image">
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
