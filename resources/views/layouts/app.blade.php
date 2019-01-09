<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mumbai Maheshwari</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/khl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/login.min.css')}}">
</head>
<body>
    <div class="login">
        <div class="login-body">
            <a class="login-brand" href="/">
                {{-- <img class="img-responsive" src="{{ asset('img/logo_khc.png') }}" alt="Komal Health Care"> --}}
            </a>
            @yield('content')
        </div>
        <div class="login-footer">
            <ul class="list-inline">
                @yield('footer-links')

                <li>|</li>
                <li>© Mumbai Maheshwari 2018</li>
            </ul>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/mms.min.js') }}"></script>
    <script>

       $('.btn-phone').click( function(){
           $(".phone-login").show();
           $(".code-login").hide();
           $(".btn-code").show();
           $("#type_login").val("otp")
           $(this).hide();
       });

        $('.btn-code').click( function(){
           $(".phone-login").hide();
           $(".code-login").show();
           $(".btn-phone").show();
           $("#type_login").val("member")
           $(this).hide();
       });

       $('#send_otp_span').click( function(){

           $.ajax({
                     url: "{{ route('send_otp') }}",
                     method: "GET",
                     data: {
                      'phone' : $("#phone").val()
                       },
                     cache: false,
                     success: function(html){

                        if(html.not_present != null)
                        {
                            alert("Number is not registered");
                        }
                        else
                        {
                            alert("Otp sent successfully");
                        }

                        return;
                     }
           });

      });



   </script>
</body>
</html>
