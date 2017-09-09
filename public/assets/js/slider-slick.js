
$('.slider-nav').slick({
    dots: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
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
    /*{ breakpoint: 1024,settings:{slidesToShow: 4,} },
    { breakpoint: 600,settings:{slidesToShow: 3,} },
    { breakpoint: 480,settings:{slidesToShow: 2,} }*/
    ]
});