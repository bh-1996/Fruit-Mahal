@extends('layouts.guest')
@section('content')
@include('flash-message')
{!! Toastr::message() !!}
    <div class="registration-form">
        <form action="{{ route('save_Delivery_Address') }}" method="POST" enctype="multipart/form-data" class="myform">
            @csrf
            <h1 class="btn btn-warning" style="margin-left:25%"><i class="fa fa-address-card" aria-hidden="true"></i> Select a delivery address</h1>
            <h1 style="text-align: center">🏠 <=============> 🏢</h1>
                <h5 style="color: blue">On the move? Pick up your order from our pickup store.</h5>

            <div class="form-group" style="text-align: center">
                <label for="sel1">Select Address Type</label>
                <select class="form-control" id="sel1" name="address_type">
                  <option value="">Select</option>
                  <option value="H">Home</option>
                  <option value="O">Office</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="full_name" class="form-control item" placeholder="Full name" value="{{ old('full_name') }}">
                @if ($errors->has('full_name'))
                <span style="color: red">{{ $errors->first('full_name') }}</span>
                @endif
            </div>
              <div class="row">
                    <div class="form-group col-sm-6">
                        <input type="varchar" name="address" id="home" class="form-control item" placeholder="Home Details" value="{{ old('address') }}">
                        @if ($errors->has('address'))
                        <span style="color: red">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="text" name="address" id="office" class="form-control item" placeholder="Office Details" value="{{ old('address') }}">
                        @if ($errors->has('address'))
                        <span style="color: red">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
              </div>
            <div class="form-group">
                <input type="varchar" name="phone" class="form-control item" placeholder="Mobile number" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                <span style="color: red">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <div class="row">
                <div class="form-group col-sm-6" style="text-align: center">
                    <label for="sel1">Select Country</label>
                    <select class="form-control" id="country" name="country">
                      <option value="">--Select--</option>
                      @foreach ($countries as $key => $value)
                      <option value="{{$value->id}}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-sm-6" style="text-align: center">
                    <label for="sel1">Select State</label>
                    <select class="form-control" id="state" name="state">
                        <option value="">Select State</option>
                    </select>
                  </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6" style="text-align: center">
                    <label for="sel1">Select City</label>
                    <select class="form-control" id="city" name="city">
                        <option value="">Select City</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="sel1">Zip_code</label>
                    <input type="text" name="zip_code" class="form-control item"  placeholder="zip_code" value="{{ old('zip_code') }}">
                    @if ($errors->has('zip_code'))
                    <span style="color: red">{{ $errors->first('zip_code') }}</span>
                    @endif
                </div>
            </div>
            <label class="checkbox-inline">
                <input type="checkbox" name="agree_terms" value="" required=""> Use as my default address.
              </label>
            <div class="form-group">
                <button  type="submit" class="btn btn-primary create-account" style="margin-left: 28%">Save Address</button>
            </div>

        </form>
        <div class="social-media">
            <h5>You already have an account? <a href="{{ route('login.post') }}">Login Here</a></h5>
        </div>
    </div>


    @section('script')
    <script>
    $(function() {
        $('#home').show();
        $('#office').show();
        $('#sel1').change(function(){
            if($('#sel1').val() == 'H') {
                $('#home').show();
                $('#office').hide();
                $("#office").val("");
            } else if($('#sel1').val() == 'O') {
                $('#office').show();
                $('#home').hide();
                $("#home").val("");
            }
            else{
                $('#home').hide();
                $('#office').hide();
                $("#office").val("");
                 $("#home").val("");
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
        <script>
            $( ".myform" ).validate({
                rules: {
                    full_name: {
                    required: true,
                    minlength:3
                  },
                  address: {
                    required: true,
                  },
                  phone: {
                    required: true,
                    integer:true,
                    min:10,
                    maxlength:11
                  },
                  country: {
                    required: true,
                  },
                  state: {
                    required: true,
                  },
                  city: {
                    required: true,
                  },
                  zip_code: {
                    required: true,
                  }
                }
              });
        </script>

        @endsection
     @endsection
