@extends("layouts.guest")
@section('content')
  <!-- contact section -->
  <section class="contact_section layout_padding2-top layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Get In <span>Touch</span></h2>
      </div>
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="form_container">
            <form action="" method="">
                @csrf
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" name="phone" class="form-control" placeholder="Phone Number" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="email" name="email" class="form-control" placeholder="Email" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" name="massege" class="message-box form-control" placeholder="Message" />
                </div>
              </div>
              <div class="btn_box">
                <button type="submit">
                  SEND
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="map_container">
            <div class="map">
              <div id=""><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.2282888492427!2d76.6903612149965!3d30.711981981644406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fee8adcb2de69%3A0x1f9510b0f5b8daed!2sNetSet%20Software%20Solutions!5e0!3m2!1sen!2sus!4v1636974429410!5m2!1sen!2sus" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->




  @endsection
