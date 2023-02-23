<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ Config::get('APP_NAME') }} - Dashboard</title>
        <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <link rel="stylesheet" href="{{asset('admin_assets/assets/css/owl-carousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/assets/css/owl-carousel/owl.theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/assets/css/datatables/datatables.min.css')}}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">


        <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/animate/animate.min.css')}}">
        @yield('css')
        {{-- Tweaks for older IEs--><!--[if lt IE 9]> --}}
        {{-- <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> --}}
        {{-- <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> --}}
    </head>
    <body id="page-top">
        <!-- Begin Preloader -->
        {{-- <div id="preloader">
            <div class="canvas">
                <img src="{{asset('admin_assets/assets/img/logo.png')}}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div> --}}
        <!-- End Preloader -->

        <div class="page">

            <!-- Begin Header -->
            @include('admin.layout.include.header')
            <!-- End Header -->

            <!-- Begin Page Content -->
            <div class="page-content d-flex align-items-stretch">
              
                <!-- start Left Sidebar -->
                    @include('admin.layout.include.left_side_bar')
                <!-- End Left Sidebar -->

                <!-- start Content -->
                    @yield('data-section')
                <!-- End Content -->

            </div>
            <!-- End Page Content -->

        </div>
        
       <div class="modal fade  fileUploadingProgresBar"  id='fileUploadingProgresBar'>
           <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">File is uploading now.</h4>
                       <button class="closeFileUploadingProgresBar" data-dismiss='modal'><span>&times;</span></button>
                   </div>
                   <div class="modal-body">
                        <div class="progress ">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                   </div>
                   <div class="modal-footer justify-content-center">
                       <strong class="uploadFailed"><a class="">Please Wait</a></strong>
                   </div>
               </div>
           </div>
       </div>
       


        <!-- Begin Vendor Js -->
        <script src="{{asset('admin_assets/assets/vendors/js/base/jquery.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/base/core.min.js')}}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{asset('admin_assets/assets/vendors/js/nicescroll/nicescroll.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/chart/chart.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/progress/circle-progress.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/calendar/moment.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/calendar/fullcalendar.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/owl-carousel/owl.carousel.min.js')}}"></script>

        {{-- database  --}}
        {{-- <script src="{{asset('admin_assets/assets/vendors/js/datatables/datatables.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/datatables/jszip.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/datatables/buttons.html5.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/datatables/pdfmake.min.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/datatables/vfs_fonts.js')}}"></script>
        <script src="{{asset('admin_assets/assets/vendors/js/datatables/buttons.print.min.js')}}"></script> --}}
        
        <script src="{{asset('admin_assets/assets/vendors/js/nicescroll/nicescroll.min.js')}}"></script>

        <script src="{{asset('admin_assets/assets/js/components/tables/tables.js')}}"></script>

        {{-- database  --}}

        <script src="{{asset('admin_assets/assets/vendors/js/app/app.js')}}"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        <script src="{{asset('admin_assets/assets/js/dashboard/db-default.js')}}"></script>
        
        {{-- notifincation  --}}
        <script src="{{asset('admin_assets/assets/vendors/js/noty/noty.min.js')}}"></script>
        {{-- <script src="{{asset('admin_assets/assets/js/components/notifications/notifications.min.js')}}"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
        <script src="{{asset('admin_assets/assets/js/r3p/r3p.js')}}"></script>

        <!-- End Page Snippets -->

        <script>
            $(document).ready(function () {

            @if(session()->has('MESSAGE'))
                new Noty({
                    type: "notification",
                    layout: "topRight",
                    text: "{{ session()->get('MESSAGE') }}",
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

        @yield('js')
       
    </body>
</html>


      
 