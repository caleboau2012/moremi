/**
 * Created by PhpStorm.
 * User: moscoworld
 * Date: 4/22/17
 * Time: 10:19 AM
 */
$(function () {
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
        pagination : false
    });

    init_Roundabout();

});
