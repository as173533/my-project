<!DOCTYPE html>
<html lang="en">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
            var logged_in = '<?= (Auth()->guard('frontend')->guest()) ? true : false; ?>';
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME', 'Math With Mantu Sir') }}</title>
        <meta name="title" content="Maths With Mantu Sir">
        <meta name="keywords" content="Maths With Mantu Sir">
        <meta name="description" content="Maths With Mantu Sir">
        <meta property="og:title" content="Maths With Mantu Sir" />
        <meta property="og:image" content="{{ URL::asset('public/frontend/images/og_image.jpg') }}" />
        <meta property="og:description" content="Math With Mantu Sir" />
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#8EC63F">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#8EC63F">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#8EC63F">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/bootstrap.min.css') }}">
        <!--fontawesome-4-->
        <link href="{{ URL::asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <!--font-->
        <link href="{{ URL::asset('public/frontend/css/icofont.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/icofont.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/stylesheet.css') }}">
       	<link href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
        <style>
            .help-block{
                color:red;
            }
        </style>
        <script type="text/javascript" src="{{ URL::asset('public/frontend/js/modernizr.min.js') }}"></script>

        @php
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        @endphp



        @yield('css')
    </head>
    <body  class="">
        <!-- Preloader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        @php
        use App\Model\Settings;
        $social_link = Settings::where('module', '=', 'Social Link')->get();
        $location = Settings::where('module', '=', 'Location')->get();
        @endphp
        <div class="wrapper">
            @include('partials.header')

            @yield('content')

            @include('partials.footer')
        </div>
       
        <!--/ ToTop trigger -->
        <!--<script src="{{ URL::asset('public/frontend/js/jquery-3.4.1.min.js') }}"></script>-->
        <script src="{{ URL::asset('public/frontend/js/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js') }}"></script>

        <script src="{{ URL::asset('public/frontend/js/popper.min.js') }}"></script>
        <!----------slider/clients------>

        <script src="{{ URL::asset('public/frontend/js/datatables.min.js') }}" type="text/javascript"></script>


        <script src="{{ URL::asset('public/frontend/custom/js/script.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}"></script>



        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js') }}" type="text/javascript"></script>



        <script>
            /*Scroll to top when arrow up clicked BEGIN*/
            $(window).scroll(function () {
                var height = $(window).scrollTop();
                if (height > 100) {
                    $('#back2Top').fadeIn();
                } else {
                    $('#back2Top').fadeOut();
                }
            });
            $(document).ready(function () {
                $("#back2Top").click(function (event) {
                    event.preventDefault();
                    $("html, body").animate({scrollTop: 0}, "slow");
                    return false;
                });

            });
            /*Scroll to top when arrow up clicked END*/
        </script>






        @yield('js')

        <!--gallery-->

        @if(Session::has('success'))
        <input type="hidden" id="success_msg" value="{{ Session::get('success') }}"/>
        <script>
            var success_msg = $('#success_msg').val();
            $.iaoAlert({
                type: "success",
                position: "top-right",
                mode: "dark",
                msg: success_msg,
                autoHide: true,
                alertTime: "3000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
                zIndex: '9999'
            });
        </script>
        @endif
        @if(Session::has('error'))
        <input type="hidden" id="error_msg" value="{{ Session::get('error') }}"/>
        <script>
            var error_msg = $('#error_msg').val();
            $.iaoAlert({
                type: "error",
                position: "top-right",
                mode: "dark",
                msg: error_msg,
                autoHide: true,
                alertTime: "3000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
                zIndex: '9999'
            });
        </script>
        @endif
    </body>
</html>