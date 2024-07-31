@extends('layouts.guest')
@section('content')
@include('flash-message')

    <div class="registration-form">
        <form action="{{ route('save.user') }}" method="POST" enctype="multipart/form-data" class="myform">
            @csrf
            {{--  <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>  --}}
            <div class="col-md-12 mb-2">
                <img id="preview-image-before-upload" src="images/default-image.png"
                    alt="preview image" style="margin-left: 30%;" class="preview">
            </div>
            <div class="form-group" style="margin-left: 35%;">
                <input type="file" name="images" placeholder="Choose image" id="image">
                  @error('image')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
            </div>
            <div class="form-group" style="text-align: center">
                <label for="sel1">Select User Type</label>
                <select class="form-control" id="sel1" name="user_type">
                  <option value="">Select</option>
                  <option value="S">Student</option>
                  <option value="T">Teacher</option>
                </select>
              </div>

            <div class="form-group">
                <input type="text" name="full_name" class="form-control item" placeholder="Full name" value="{{ old('full_name') }}">
                @if ($errors->has('full_name'))
                <span style="color: red">{{ $errors->first('full_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control item" id="email" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span style="color: red">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control item"  placeholder="Password">
                @if ($errors->has('password'))
                <span style="color: red">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="cpass" class="form-control item"  placeholder="Confirm Password">
                @if ($errors->has('cpass'))
                <span style="color: red">{{ $errors->first('cpass') }}</span>
                @endif
            </div>
             <div class="form-group">
                <input type="varchar" name="address" class="form-control item" placeholder="Home Address" value="{{ old('address') }}">
                @if ($errors->has('address'))
                <span style="color: red">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="text" name="zip_code" class="form-control item"  placeholder="zip_code" value="{{ old('zip_code') }}">
                @if ($errors->has('zip_code'))
                <span style="color: red">{{ $errors->first('zip_code') }}</span>
                @endif
            </div>
            <div class="form-group" style="text-align: center">
                <label for="class">Select</label>
                <select class="form-control" id="class" name="class">
                  <option value="">--Select class--</option>
                  <option value="10">10th</option>
                  <option value="12">12th</option>
                  <option value="UG">UG</option>
                  <option value="PG">PG</option>
                </select>
              </div>

              <div class="form-group">
                <input type="text" name="subject" id="subject" class="form-control item"  placeholder="Subject" value="{{ old('subject') }}">
                @if ($errors->has('subject'))
                <span style="color: red">{{ $errors->first('subject') }}</span>
                @endif
            </div>
            <div class="form-group" style="text-align: center">
                <label for="sel1">Select Country</label>
                <select class="form-control" id="country" name="country">
                  <option value="">--Select--</option>
                  @foreach ($countries as $key => $value)
                  <option value="{{$value->id}}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" style="text-align: center">
                <label for="sel1">Select State</label>
                <select class="form-control" id="state" name="state">
                    <option value="">Select State</option>
                </select>
              </div>
              <div class="form-group" style="text-align: center">
                <label for="sel1">Select City</label>
                <select class="form-control" id="city" name="city">
                    <option value="">Select City</option>
                </select>
              </div>



            {{--  <div class="form-group">
                Upload profile image  <input type="file" name="images">
            </div>  --}}
            <label class="checkbox-inline">
                <input type="checkbox" name="agree_terms" value="" required=""> I agree with all terms & policies.
              </label>
            <div class="form-group">
                <button  type="submit" class="btn btn-block create-account">Register</button>
            </div>

        </form>
        <div class="social-media">
            <h5>You already have an account? <a href="{{ route('login.post') }}">Login Here</a></h5>
        </div>
    </div>


    @section('script')
    <script>
    $(function() {
        $('#class').show();
        $('#subject').show();
        $('#sel1').change(function(){
            if($('#sel1').val() == 'S') {
                $('#class').show();
                $('#subject').hide();
                $("#subject").val("");
            } else if($('#sel1').val() == 'T') {
                $('#subject').show();
                $('#class').hide();
                $("#class").val("");
            }
            else{
                $('#class').hide();
                $('#subject').hide();
                $("#subject").val("");
                 $("#class").val("");
            }
        });
    });
    </script>
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
        <script>
            $(document).ready(function () {
                $('#country').on('change', function () {
                    var idCountry = this.value;
                    $("#state").html('');
                    $.ajax({
                        url: "{{url('/states')}}",
                        type: "POST",
                        data: {
                            country_id: idCountry,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#state').html('<option value="">Select State</option>');
                            $.each(result.states, function (key, value) {
                                $("#state").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $('#city').html('<option value="">Select City</option>');
                        }
                    });
                });
                $('#state').on('change', function () {
                    var idState = this.value;
                    $("#city").html('');
                    $.ajax({
                        url: "{{url('/cities')}}",
                        type: "POST",
                        data: {
                            state_id: idState,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (res) {

                            $('#city').html('<option value="">Select City</option>');
                            $.each(res.cities, function (key, value) {
                                $("#city").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                });
            });

        </script>
        @endsection
     @endsection
