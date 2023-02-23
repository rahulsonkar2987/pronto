
<!--Login form Modal start here -->
  <div class="modal fade login show_login_modal" id="login-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="myform">
              <h1 class="text-center">Login</h1>             
              <div class="row login gx-3 clearfix">
                <div class="col-12 col-lg-6">
                        <a href="{{ route('facebookLogin') }}" class="btn d-block fb wave-effect"> <i class="fa fa-facebook"></i> Continue with Facebook</a>
                </div>
                <div class="col-12 col-lg-6">
                    <a href="{{ route('googleLogin') }}" class=" btn d-block google wave-effect"><i class="fa fa-google"></i> Continue with Google</a>
                </div>
              </div>
              <div class="separator clearfix"></div>
              <form  id="formLogin" method="POST">
              {{-- <form action="{{ route('login') }}" method="POST"> --}}
                {{-- @csrf --}}
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email Address"  class="form-control">
                </div>
                <div class="position-relative">
                  <i class="pass-hide bi bi-eye-slash" id="togglePassword" ></i>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password"  />
                </div>
                <div class="row mt-1 mb-3 clearfix">
                  <div class="col-12 text-end">
                    <a href="{{ route('password.request') }}" class="f-password">Forgot Password</a>
                  </div>
                </div>
                <input type="submit" id="login_btn" value="Login" class="w-100">
                <div class="options text-center mt-3">
                    Not a Member yet? <a href="{{ route('register') }}">Create Account</a>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye / eye slash icon
      this.classList.toggle('bi-eye');
    });
  </script>
<!--Login form Modal end here -->
