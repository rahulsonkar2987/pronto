    <!-- Navber Section Starts -->
    <nav class="navbar bg-navbar sticky-top mobile">
        <div class="container-fluid">
          <a class="navbar-brand" href="\"><img src="{{ asset(Config::get('logo')) }}" class="img-fluid" alt="logo" /></a>
          <div class="me-0">
            <a class="topnav" href="{{  route('addToCard.index')  }}">
              <i class="bi bi-cart"></i>
            </a>
            <a class="topnav" data-bs-toggle="offcanvas" data-bs-target="#mobileNavbar"
              aria-controls="mobileNavbar">
              <i class="bi bi-list"></i>
          </a>
          </div>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileNavbar" aria-labelledby="mobileNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="mobileNavbarLabel"><img src="{{ asset('/') }}images/logo.png" class="img-fluid" alt="Card" /></h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link naveffects active" aria-current="page" href="{{ route('index') }}" data-text="Home"><span>Home</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link naveffects" href="#" data-text="How it Works"><span>How it Works</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link naveffects" href="#" data-text="Buy Books"><span>Buy Books</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link naveffects" href="#" data-text="Sell Books"><span>Sell Books</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link naveffects" href="#" data-text="Contact Us"><span>Contact Us</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="#" data-text="Login" data-bs-toggle="modal" data-bs-target="#login-form"><span>Login</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link naveffects" href="{{ route('register') }}" data-text="Register"><span>Register</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
  
    <nav class="navbar navbar-expand-lg bg-navbar sticky-top desktop">
      <div class="container">
        <a class="navbar-brand" href="\"><img src="{{ asset(Config::get('logo')) }}" class="img-fluid" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link naveffects active" aria-current="page" href="{{ route('index') }}" data-text="Home"><span>Home</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link naveffects" href="#" data-text="How it Works"><span>How it Works</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link naveffects" href="#" data-text="Buy Books"><span>Buy Books</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link naveffects" href="#" data-text="Sell Books"><span>Sell Books</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link naveffects" href="#" data-text="Contact Us"><span>Contact Us</span></a>
              {{-- <a class="nav-link naveffects" href="#" data-text="Contact Us"><span> --}}
            </span></a>
            </li>
          </ul>

          <ul class="navbar-nav nav-right me-0">
            @if(session()->has('email'))
              <span class="text-white"><a href="{{ route('user.dashboard')}}">Dashboard</a></span>
              <a class="nav-link" href="{{ route('logout') }}"><span>(Logout)</span></a>
            @else
              <li class="nav-item">
                {{-- <a class="nav-link link--leda" href="#" data-text="Login" data-bs-toggle="modal" data-bs-target="#login-form"><span>Login</span></a> --}}
                <a class="nav-link naveffects login_modal" href="#" id="" data-text="Login" ><span>Login</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link naveffects" href="{{ route('register') }}" data-text="Register"><span>Register</span></a>
              </li>
            @endauth  
            <li class="nav-item">
              <a href="{{ route('addToCard.index') }}"><img src="{{ asset('/') }}images/cart.png" class="img-fluid" alt="Card"></a>
              <div class="cart-link noOfItems">{{ session()->has('buyBookCard') ? count(session()->get('buyBookCard')) : '0' }}</div></a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
      <!-- Navbar Section Ends -->
  