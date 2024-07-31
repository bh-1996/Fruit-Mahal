<!-- header section strats -->
  <header class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ route('index.post') }}">
          <span>Fruits🍇🍉Mahal</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('index.post') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('about.post') }}"> About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('fruit.post') }}">Fruits</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('blog.post') }}">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('contact.post') }}">Contact Us</a>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                 @if (Auth::guest())
                    <a class="nav-link dropdown-toggle" href="{{ route('signup.post') }}" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign Up</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="{{ route('login.post') }}">Log In</a>
                        <a class="dropdown-item" href="{{ route('signup.post') }}">Register</a>
                @else
                    <a class="nav-link dropdown-toggle" href="{{ route('signup.post') }}" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->full_name }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if((Auth::user() != '') && Auth::user()->user_type == 'T')
                            <a class="dropdown-item" href="{{ route('user.post') }}">User List</a>
                        @endif
                            <a class="dropdown-item" href="{{ route('profile.post',Auth::user() )}}">My Profile</a>
                            <a class="dropdown-item" href="{{ route('product.page',Auth::user() )}}">Manage fruits</a>
                            <a class="dropdown-item" href="{{ route('logout.post') }}">Log Out</a>
                        @endif
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a href="{{ route('cart') }}" class="btn btn-light">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </a>
              </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <!-- end header section -->
