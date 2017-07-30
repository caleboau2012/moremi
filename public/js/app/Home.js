/**
 * Created by PhpStorm.
 * User: moscoworld
 * Date: 4/22/17
 * Time: 10:19 AM
 */
$(function () {
    $(window).stellar({
        horizontalScrolling: false
    });

    // Custom Scrollbar
    var nice = $("html").niceScroll({
        cursorwidth: 8,
        cursorborder: "0px solid #fff",
        cursorborderradius: '0'
    });

    $('.main-nav a:not(.dropdown-toggle)').bind('click', function(event) {
        var $anchor = $(this);

        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');

        event.preventDefault();
    });
    /*
     * Fun Fact with Count Animation
     */
    $('.st-ff-count').appear();
    $(document.body).on('appear', '.st-ff-count', function(e, $affected) {
        $affected.each(function(i) {
            if (parseInt($(this).data('runit'))) {
                $(this).countTo({
                    speed: 3000,
                    refreshInterval: 50
                });
                $(this).data('runit', "0");
            };

        });
    });

    $('[data-toggle="tooltip"]').tooltip();


    function home_height () {
        var element = $('.st-home-unit'),
            elemHeight = element.height(),
            winHeight = $(window).height()
        var padding = (winHeight - elemHeight - 250) /2;

        if (padding < 1 ) {
            padding = 0;
        };
        element.css('padding', padding+'px 0');
    }
    home_height ();

    $(window).resize(function () {
        home_height ();
    });


    var fadeStart=$(window).height()/3 // 100px scroll or less will equiv to 1 opacity
        ,fadeUntil=$(window).height() // 200px scroll or more will equiv to 0 opacity
        ,fading = $('.st-home-unit')
        ,fading2 = $('.hero-overlayer')
        ;

    $(window).bind('scroll', function(){
        var offset = $(document).scrollTop()
            ,opacity=0
            ,opacity2=1
            ;
        if( offset<=fadeStart ){
            opacity=1;
            opacity2=0;
        }else if( offset<=fadeUntil ){
            opacity=1-offset/fadeUntil;
            opacity2=offset/fadeUntil;
        }
        fading.css({'opacity': opacity});

        if (offset >= 120) {
            $('.st-navbar').addClass("st-navbar-mini");
        } else if (offset <= 119) {
            $('.st-navbar').removeClass("st-navbar-mini");
        }
    });


    $('.clients-carousel').owlCarousel({
        items: 5,
        autoPlay: true,
        pagination: false
    });

    function init_Roundabout() {
        $('.roundabout').roundabout({
            tilt: 0.4,
            autoplay: true,
            autoplayDuration: 5000,
            autoplayPauseOnHover: true,
            minScale:0.5,
            minOpacity: 1,
            duration: 400,
            easing: 'easeOutQuad',
            enableDrag: true,
            dropEasing: 'easeOutBack',
            dragFactor: 2,
            responsive: true
        });
    }

    /* Trending Block */
    $(".trending-items").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items : 4,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,3],
        itemsTablet	: [768,2],
        navigation : false,
        navigationText : ['Prev', 'Next'],
        pagination : true
    });


    init_Roundabout();

     [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
         new CBPFWTabs( el );
     });

});
