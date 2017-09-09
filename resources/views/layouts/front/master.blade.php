<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Meta & title -->
        @yield('meta')

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frameworks.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-social.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/font-elegant.css') }}">
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

        <!-- Style Dashboard -->
        @yield('style-dashboard')
    </head>
    <body>
        <!-- Header -->
        @include('layouts.front.commons.header')
        <!-- End header -->

        <!-- Content -->
        @yield('content')
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.front.commons.footer')
        <!-- End footer -->
        
        <!-- Script -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/price.js') }}"></script>
        <script src="{{ asset('assets/js/grid-list-show.js') }}"></script>
        <!-- Detail product -->
        <script src="{{ asset('assets/js/notify.min.js') }}"></script>
        <script src="{{ asset('assets/js/product-detail.js') }}"></script>
        <script src="{{ asset('assets/js/slider-slick.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
                $('.overlay').click(function(){
                    var url = $(this).parent().find('.product-detail-url').attr('href');
                    if( typeof url === "undefined"){
                        return true;
                    }else{
                        window.location = url;
                        return false;
                    }

                });
                $('.rating input').each(function () {
                   if($(this).is(':checked')){
                       $('.rating label').removeClass('hovered');
                       $(this).parent().addClass('hovered');
                   }
                });
                $('.rating input').change(function () {
                    $('.rating label').removeClass('hovered');
                    if($(this).is(':checked')){
                        $(this).parent().addClass('hovered');
                    }
                });
            });
        </script>
        @include('front.messages')
    </body>
</html>