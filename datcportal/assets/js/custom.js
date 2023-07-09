


//Testi slider
$(document).ready(function () {
$('.testi-slides').flexslider({
    animation: 'slide',
    directionNav: false
});
});



//ACCORDION
$(document).ready(function () {
$('.panel-heading a[data-toggle="collapse"]').on('click', function () {
    if ($(this).closest('.panel-heading').hasClass('active')) {
        $(this).closest('.panel-heading').removeClass('active');
    } else {
        $('.panel-heading a[data-toggle="collapse"]').closest('.panel-heading').removeClass('active');
        $(this).closest('.panel-heading').addClass('active');
    }
});
});

//paraallax
//parallax
$(document).ready(function () {
    $(window).stellar({
        horizontalScrolling: false,
        responsive: true/*,
         scrollProperty: 'scroll',
         parallaxElements: false,
         horizontalScrolling: false,
         horizontalOffset: 0,
         verticalOffset: 0*/
    });
});

//MAGNIFIC POPUP
$(document).ready(function () {
    $('.show-image').magnificPopup({type: 'image'});
});

//    wow animation

$(document).ready(function () {
    var wow = new WOW(
            {
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 100, // distance to the element when triggering the animation (default is 0)
                mobile: false        // trigger animations on mobile devices (true is default)
            }
    );
    wow.init();
});


