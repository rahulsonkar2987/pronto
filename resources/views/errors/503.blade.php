<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('setting.pn') }} - Error 404</title>
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
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin_assets/assets/img/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin_assets/assets/img/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin_assets/assets/img/favicon-16x16.png')}}">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendors/css/base/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendors/css/base/elisyam-1.5.min.css')}}">
    </head>
    <body class="bg-error-01">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="assets/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid h-100 error-01">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12">
                    <!-- Begin Container -->
                    <div class="error-container mx-auto text-center">
                        <h2  style="font-size:100px">COMMING SOON</h2>
                        {{-- <h2>This page cannot be found! </h2> --}}
                        <p >Our website is under construction </p>
                    </div> 
                    <!-- End Container -->
                </div>
                <!-- End Col -->
            </div> 
            <!-- End Row -->
        </div>
        <!-- End Container -->
        <!-- Begin Vendor Js -->
        <script src="{{ asset('admin_assets/assets/vendors/js/base/jquery.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/vendors/js/base/core.min.js')}}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{ asset('admin_assets/assets/vendors/js/app/app.min.js')}}"></script>
        <!-- End Page Vendor Js -->
    </body>
</html>