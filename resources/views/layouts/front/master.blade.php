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
        <script src="{{ asset('assets/js/product-detail.js') }}""></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.slider-nav').slick({
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
                $('.slider-for').slick({slidesToShow: 1,slidesToScroll: 1,arrows: false,fade: true,asNavFor: '.slider-nav-one'});
                $('.slider-nav-one').slick({slidesToShow: 1,slidesToScroll: 1,asNavFor: '.slider-for',dots: false,centerMode: false,focusOnSelect: true,responsive: [
                    { breakpoint: 1024,settings:{slidesToShow: 4,} },
                    { breakpoint: 600,settings:{slidesToShow: 3,} },
                    { breakpoint: 480,settings:{slidesToShow: 2,} }
                    ]
                });
                $('.single-item').slick();
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
                $('.overlay').click(function(){
                    var url = $(this).parent().find('.product-detail-url').attr('href');
                    window.location = url;
                    return false;
                });
            });
        </script>
    </body>
</html>