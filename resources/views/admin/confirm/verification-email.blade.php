<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Elisyam - Confirm Email</title>
        <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
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
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin_assets/assets/img/apple-touch-icon.png') }}">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendors/css/base/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendors/css/base/elisyam-1.5.min.css')}}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="bg-fixed-02">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="{{ asset('admin_assets/assets/img/logo.png') }}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid h-100 overflow-y">
            <div class="row flex-row h-100">
                <div class="col-12 my-auto">
                    <div class="mail-confirm mx-auto">
                        <div class="animated-icon">
                            <div class="gradient"></div>
                            <div class="icon"><i class="la la-at"></i></div>
                        </div>
                        {{-- <h3>Confirm your email address!</h3> --}}
                        <h3>{{ $title }}</h3>
                        {{-- <p>
                            A confirmation email has been sent to <a href="#">example@yourmail.com</a> 
                        </p> --}}
                        {{-- <p>
                            Check your inbox and click on the link to confirm your email address.
                        </p> --}}
                        <div class="button text-center">
                            <a href="{{ url('/') }}" class="btn btn-lg btn-gradient-01">
                                Login Page
                            </a>
                        </div>
                    </div>        
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>  
        <!-- End Container -->  
        <!-- Begin Vendor Js -->
        <script src="{{ asset('admin_assets/assets/vendors/js/base/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_assets/assets/vendors/js/base/core.min.js') }}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{ asset('admin_assets/assets/vendors/js/app/app.min.js') }}"></script>
        <!-- End Page Vendor Js -->
    </body>
</html>