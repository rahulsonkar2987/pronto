
<!doctype html>
<html>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    <title>{{ Config::get('APP_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Config::get('favicon') }}" sizes="32x32" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&display=swap">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/base.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/theme.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/amit.css">


    @yield('css')


  </head>

  <body>

    

     {{-- header start here  --}}
     @include('layouts.include.header')
     {{-- header end here  --}}

     <div class="alert  fade {{ session()->has('MESSAGE') ? 'show' : '' }} error_msg" style="position:fixed" role="alert" data-tor="show:scale.from(0)">
        <span>
          @if (session()->has('MESSAGE'))
            {{ session::get('MESSAGE') }}
          @endif
        </span>
          <button type="button" class="btn-close" aria-label="Close"></button>
      </div>


    {{-- /------ index start hrer  --}}
    @yield('index')
    {{-- /------ index end hrer  --}}


    {{-- login model  --}}
    @include('auth.login')
    {{-- login model  --}}

    {{-- header start here  --}}
    @include('layouts.include.footer')
    {{-- header end here  --}}

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}js/owl.carousel.js"></script>
    <script src="{{asset('admin_assets/assets/js/r3p/r3p.js')}}"></script>

    <script>
      $('.best-sellers').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        autoplay: true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:4
          },
          1000:{
            items:6
          }
        }
      });
      $('.testimonials').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        autoplay: true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:1
          },
          1000:{
            items:2
          }
        }
      });
    </script>

    <script>
      $(document).ready(function(){
      //////////////////////////////////////////

        // login open modal start here 
          $('.login_modal').click(function (e) { 
            e.preventDefault();
            $('.show_login_modal').modal('show');
          });
        // login open modal end here 
        

        $('#formLogin').submit(function(e){
            e.preventDefault();
            var formdata = new FormData(this);

            $(document).find("span.error").remove();
            $.ajax({
                url: "{{route('login',['_token'=>csrf_token()])}}",
                type: "post",
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                error:function (jqXHR,get_error) {
                  getError(jqXHR,get_error);
                },
                success: function(get){
                    // console.log(get.data);
                    if(get.success==true){
                        window.location.href="{{route('user.dashboard')}}";
                    }else if(get.success==false && get.msg=='unVerified'){
                      var email = get.email;
                      window.location.href="{{ route('verification.create','') }}"+"/"+email;
                    }
                }
            });
        });


        // buy add to cart start  here 
        $(document).on('click','.addToCard', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var no = $('.noOfItems').text();
            $.ajax({
              type: "get",
              url: "{{ route('addToCard.store') }}",
              data: {id:id},
              success: function (get) {
                if (get.success==true) {
                  $('.noOfItems').text(parseInt(no)+parseInt(get.no));
                  $(".error_msg span").text(get.msg);
                  $(".error_msg").addClass('show');
                  setTimeout(function(){ 
                    $('.error_msg').removeClass('show'); 
                  }, 2000);
                }
              }
            });
        });
        $(document).on('click','.addToCard_single', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var quantity = $(".get_quantity").val();
            var no = $('.noOfItems').text();
            var self = this;
            $.ajax({
              type: "get",
              url: "{{ route('addToCard.update') }}",
              data: {id:id,quantity:quantity},
              success: function (get) {
                if (get.success==true) {
                  $('.noOfItems').text(parseInt(no)+parseInt(get.no));
                  $(".error_msg span").text(get.msg);
                  $(".error_msg").addClass('show');
                  setTimeout(function(){ 
                    $('.error_msg').removeClass('show'); 
                  }, 2000);
                }
              }
            });
        });
        // buy add to cart end here

        $('.error_msg button').on('click',function () {
          $('.error_msg').removeClass('show');
        });

        // add quantity  start here 
          $(document).on('change','.add_quantity', function (e) {
            e.preventDefault();
            var id  = $(this).data('id');
            var quantity = $(this).val();
            $.ajax({
              type: "get",
              url: "{{ route('addToCard.update') }}",
              data: {id:id,quantity:quantity},
              success: function (get) {
              
              }
            });
          });
        // add quantity  end here 

        // remove cart item start here 
        $(document).on('click','.cart_remove', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            // var quantity = $(this).parent('div').child('#quantity').val();
            // alert('quantity');
            var rm = this;
            $.ajax({
              type: "get",
              url: "{{ route('addToCard.destroy') }}",
              data: {id:id},
              success: function (get) {
                if (get.success==true) {
                  location.reload();
                }
              }
            });
        });
        // remove cart item end here 



        ////////////////////////////////////////////////
      });
    </script>
    @yield('js')
  </body>
</html>