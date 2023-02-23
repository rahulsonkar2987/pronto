<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ Config::get('APP_NAME').'-'.config('setting.plt') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(App\Models\Config::where('key','favicon')->first()->value) }}">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{asset('admin_assets/assets/vendors/css/base/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/assets/vendors/css/base/elisyam-1.5.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/animate/animate.min.css')}}">

        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    </head>
    <body class="bg-white">
        <!-- Begin Preloader -->
        {{-- <div id="preloader">
            <div class="canvas">
                <img src="{{asset('admin_assets/assets/img/logo.png')}}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div> --}}
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
                    <div class="elisyam-bg background-01" >
                        <div class="elisyam-overlay overlay-01" style="background:#dc3545"></div>
                        <div class="authentication-col-content mx-auto">
                            <h1 class="gradient-text-01 text-center">
                                Welcome To {{ Config::get('APP_NAME') }}
                            </h1>
                            <span class="description">
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="db-default.html">
                                <img src="{{ asset(App\Models\Config::where('key','logo')->first()->value) }}" alt="logo">
                            </a>
                        </div>
                        <h3>Sign In To {{ Config::get('APP_NAME') }}</h3>
                        <form action="{{ route('admin.login') }}" method="POST" >
                        {{-- <form action="" id='form_submit' method="POST" > --}}
                            @csrf
                            <label>UserName</label>
                            <div class="group material-input">
							    <input class="form-control py-3 username"  type="email" name='email'>
							    <span class="highlight"></span>
							    <span class="bar"></span>
                            </div>
                            <div class="group material-input">
							    <input class="form-control py-3 password"  type="password" name='password'>
							    <span class="highlight"></span>
							    <span class="bar"></span>
							    <label>Password</label>
                            </div>
                            <div class="row">
                                <label for="remember_me" class="col text-left">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="sign-btn text-center">
                                <button  class="btn btn-lg btn-gradient-01">Sign in </button>
                            </div>
                        </form>
                        
                    </div>
                    <!-- End Form -->                        
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->    
        <!-- Begin Vendor Js -->
        <script src="{{asset('admin_assets/assets/vendors/js/base/jquery.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/base/core.min.js')}}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{asset('admin_assets/assets/vendors/js/app/app.min.js')}}"></script>
        <!-- End Page Vendor Js -->
        <script src="{{asset('admin_assets/assets/vendors/js/noty/noty.min.js')}}"></script>

        <script>
            $(document).ready(function(){
                $('#form_submit').submit(function(e){
                    e.preventDefault();
                    var formdata = new FormData(this);

                    $(document).find("span.error").remove();
                    $.ajax({
                        url: "{{route('admin.login',['_token'=>csrf_token()])}}",
                        type: "post",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        error:function (get_error) {
                            $.each(get_error.responseJSON.errors,function(field_name,error){
                                $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger error">' +error+ '</span>');
                            });
                        },
                        success: function(get){
                            // console.log(get.data);
                            if(get.data=='login'){
                                window.location.href="{{route('admin.dashboard')}}";
                            }else if(get.data=='error'){
                                $('.alert .error').html('');
                                $('.alert .close').after('<strong class="error">'+get.msg+'</strong> ');
                                $('.alert').addClass('show');
                            }
                        }
                    });
                });


            @if($errors->any())
                new Noty({
                    type: "notification",
                    layout: "topRight",
                    text: "{!! implode('', $errors->all('<div>:message</div>')) !!}",
                    closeWith: ["click", "button"],
                    progressBar: true,
                    timeout: 2500,
                    animation: {
                        open: "animated bounceInRight",
                        close: "animated bounceOutRight"
                    }
                }).show()
            @endif

            });
        </script>
    </body>
</html>