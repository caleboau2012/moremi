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

    init_Roundabout();

});
