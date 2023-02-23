@extends('layouts.app')

@section('index')
    
<!-- sign-up AMIT -->
<div class="sign-up">
    <div class="container">
      <div class="row up-blk">
        <div class="col-md-6 ">
          <div class="txt-box">
            <h1>Hello Reader</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni voluptates, accusantium excepturi sint dicta expedita.</p>
          </div>
          <img src="images/sign-up.svg" class="img-fluid" alt="image">
        </div>
        <div class="col-md-6">
            <div class="mySign-up">
                <h1>Create An Account:</h1>
               
                <div class="row login gx-3 clearfix">
                  <div class="col-12 col-lg-6">
                          <a href="" class="btn d-block facebook wave-effect"> <i class="fa fa-facebook"></i> Continue with Facebook</a>
                  </div>
                  <div class="col-12 col-lg-6">
                      <a href="{{ route('googleLogin') }}" class=" btn d-block google wave-effect"><i class="fa fa-google"></i> Continue with Google</a>
                  </div>
                </div>

                <div class="separator-sign-up clearfix"></div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row cleaarfix">
                        <div class="col-12 col-lg-6 mb-3">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="wave-effect form-control" placeholder="First Name*">
                            <span class="text-danger">@error('first_name'){{ $message; }} @enderror</span>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="wave-effect form-control required" placeholder="Last Name*">
                            <span class="text-danger">@error('last_name'){{ $message; }} @enderror</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email*"  class="form-control">
                        <span class="text-danger">@error('email'){{ $message; }} @enderror</span>
                    </div>

                    <div class="align-center mb-3 align-items-center">
                      <input type="password" name="password"  autocomplete="new-password" class="form-control" autocomplete="off" placeholder="Password*" id="password" />
                      <span class="text-danger">@error('password'){{ $message; }} @enderror</span>
                    </div>

                    <div class="align-center mb-3 align-items-center">
                      <input type="password" name="password_confirmation"  class="form-control" autocomplete="off" placeholder="Confirm Password*" id="c_password" />
                      <span class="text-danger">@error('password_confirmation'){{ $message; }} @enderror</span>
                    </div>

                    <div class="align-center  mb-3 align-items-center">
                      <input type="text" name='phone' value="{{ old('phone') }}" class="form-control" autocomplete="off" placeholder="Phone Number"  />
                      <span class="text-danger">@error('phone'){{ $message; }} @enderror</span>
                    </div>

                    <div class="mb-3 form-check">
                      <input type="checkbox" name="terms_conditions" value="1" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Accept Terms & Conditions</label><br>
                      <span class="text-danger">@error('terms_conditions'){{ $message; }} @enderror</span>
                    </div>

                    <input type="submit" class="btn w-100 btn-login wave-effect" value="Create Account">
                    <div class="not-member text-center pt-3">
                        <a href="\" data-text="Login" data-bs-toggle="modal" data-bs-target="#login-form" class="a">Already have an Account? <span>Login</span></a>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection