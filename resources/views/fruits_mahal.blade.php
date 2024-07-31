@extends("layouts.guest")
@section('content')

    <!-- product section -->

    <section class="product_section layout_padding2-top layout_padding-bottom">

        <div class="container">
            <div class="heading_container heading_center">
                <h1>
                    Our Fruits
                </h1>
                <hr>
                <form method="GET">
                    <input type="text" name="search" class="typeahead" placeholder="Search category" autocomplete="off"
                        required />
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
                <hr>
                <p>
                    which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to
                    be sure there isn't an
                </p>
            </div>

            <div class="row">
                @foreach ($product as $fruit)
                    <div class="col-sm-6 col-lg-4">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('product_img/' . $fruit->image) }}" alt="$fruit->image">
                            </div>
                            <div class="detail-box">
                                <p><input data-id="{{ $fruit->id }}"
                                    type="checkbox" data-onstyle="success" data-offstyle="danger"
                                    data-toggle="toggle" data-on="In Stock" data-off="Out of Stock"
                                    {{ $fruit->status ? 'checked' : '' }}></p>
                                <h2>
                                    Upto 20% Off
                                </h2>
                                <button class="btn btn-warning">
                                    <a href="{{ route('viewProduct',$fruit->id) }}">
                                        Shop Now
                                    </a>
                                </button>
                            </div>
                            <div class="detail-box">
                                <span class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </span>
                                <a href="" style="color: Blue; font-size:1.5rem">
                                    {{ $fruit->title }}
                                </a>
                                <p>{{ $fruit->description }}</p>
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


        </div>
    </section>

    <!-- end product section -->
@section('script')
    <script>
        $('#fruits').on('keyup', function() {
            search();
        });
        search();

        function search() {
            var keyword = $('#fruits').val();
            $.post('{{ route('searchCategory') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        }
        // table row with ajax
        function table_post_row(res) {
            let htmlView = '';
            if (res.categories.length <= 0) {
                htmlView += `
           <tr>
              <td colspan="4">No data.</td>
          </tr>`;
            }
            for (let i = 0; i < res.categories.length; i++) {
                htmlView += `
            <tr>
               <td>` + (i + 1) + `</td>
                  <td>` + res.categories[i].title + `</td>
                   <td>` + res.categories[i].description + `</td>
            </tr>`;
            }
            $('tbody').html(htmlView);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js" integrity="sha512-Rc24PGD2NTEGNYG/EMB+jcFpAltU9svgPcG/73l1/5M6is6gu3Vo1uVqyaNWf/sXfKyI0l240iwX9wpm6HE/Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var path = "{{ route('searchCategory') }}";
        _token: $('meta[name="csrf-token"]').attr('content'),
        $('input.typeahead').typeahead({
            source: function(search, process) {
                return $.get(path, {
                    search: search,
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>

@endsection

@endsection
