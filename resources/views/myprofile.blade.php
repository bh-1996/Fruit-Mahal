@extends('layouts.guest')
@section('content')
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
          My Profile
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
        <div class="col-md-8">
          <div class="white-background box">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <span>{{ $user->full_name }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span>{{ $user->email }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">User ID</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span>{{ $user->id }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Class</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span>{{ $user->class }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Subject</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <span>{{ $user->subject }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ $user->address }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Country</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ $user->country }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">State</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ $user->state }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Pin code</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <span>{{ $user->zip_code }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="{{ route('profileedit.post',$user->id) }}">Edit profile</a>
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
