



$("#cssmenu").menumaker({
    format: "multitoggle",
    title: '<style="display: none;">',
    breakpoint:  991,
});
$('.test_slider').slick({
    arrows: true,
});


$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    centerMode: true,
    focusOnSelect: true
});



$('.act_slider').slick({
    slidesToShow: 2,
    // infinite: true,
    // autoplay: true,
    autoplaySpeed: 5000,
    // centerMode: true,
    // centerPadding: '60px',
    responsive: [
        {
            breakpoint: 991,
            settings: {
                arrows: false,
                centerMode: true,
                // centerPadding:, '40px',
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '10px',
                slidesToShow: 1
            }
        }
    ]
});


$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
        $("#navigation").addClass("mynav");
        document.getElementById("navigation").style.padding = "10px";
        document.getElementById("img_adjust ").style.width = "130px";
        // document.getElementsByClass("img_adjust ").style.height = "130px";
    }
    else
    {
        $("#navigation").removeClass("mynav");
        document.getElementById("navigation").style.padding = "15px";
    }
});


// if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
//
// } else {
//   document.getElementById("navigation").style.padding = "10px";
// }
// }
