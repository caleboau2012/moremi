
$(document).ready(function () {
    "use strict";
    ////////////////////////////////////Responsive Image Replace////////////////////////////////////////////

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $(window).width() < 800) {

        var imgs = document.getElementsByTagName("img");

        for (var i = 0; i < imgs.length; i++) {
            imgs[i].src = imgs[i].src.replace("images/home1/desktop", "images/home1/tablet");
        }  // some code..
    }


    window.onresize = function () { location.reload(); }

    /* -------------------------------------------------------------------------*
     *Gallery: Magnific Popup
     * -------------------------------------------------------------------------*/

    if ($('.popup-gallery').length > 0) {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function (item) {
                    return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });
    }


    if ($('#gallery-popup1, #gallery-popup2, #gallery-popup3').length > 0) {
        $('#gallery-popup1, #gallery-popup2, #gallery-popup3').magnificPopup({
            items: [
                {
                    src: 'HtmlPage2.html',
                    type: 'iframe' // this overrides default type
                }
            ],
            gallery: {
                enabled: true
            },
            type: 'image' // this is a default type
        });
    }
    if ($('#OneImage-popup1').length > 0) {
        $('#OneImage-popup1').magnificPopup({
            items: [
                {
                    src: '../images/home1/fashion-bag-big.jpg',
                    title: 'New Bags'
                },
            ],
            gallery: {
                enabled: true
            },
            type: 'image' // this is a default type
        });
    }



    if ($('#OneImage-popup2').length > 0) {
        $('#OneImage-popup2').magnificPopup({
            items: [
                {
                    src: '../images/home1/fashion-hair-big.jpg',
                    title: 'Hair Style '
                },
            ],
            gallery: {
                enabled: true
            },
            type: 'image' // this is a default type
        });
    }


    if ($('#Vimeo-popup1, #Vimeo-popup2, #Vimeo-popup3, #Vimeo-popup4').length > 0) {
        $('#Vimeo-popup1, #Vimeo-popup2, #Vimeo-popup3, #Vimeo-popup4').magnificPopup({
            items: [
                {
                    src: 'http://vimeo.com/123123',
                    type: 'iframe' // this overrides default type
                }


            ],
            gallery: {
                enabled: true
            },
            type: 'image' // this is a default type
        });
    }

    /* -------------------------------------------------------------------------*
     * TREE SCRIPT
     * -------------------------------------------------------------------------*/

    $.fn.extend({
        treed: function (o) {

            var openedClass = 'fa fa-angle-right';
            var closedClass = 'fa fa-angle-down';

            if (typeof o != 'undefined') {
                if (typeof o.openedClass != 'undefined') {
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined') {
                    closedClass = o.closedClass;
                }
            }
            ;

            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                })
                branch.children().children().toggle();
            });
            //fire event from the dynamically added icon
            tree.find('.branch .indicator').each(function () {
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });

    //Initialization of treeviews

    $('#tree1').treed();

    $('#tree2').treed({openedClass: 'glyphicon-folder-open', closedClass: 'glyphicon-folder-close'});

    $('#tree').treed({openedClass: 'fa fa-angle-down', closedClass: 'fa fa-angle-right'});


    /* -------------------------------------------------------------------------*
     * Preloader Script
     * -------------------------------------------------------------------------*/
    //<![CDATA[
    $(window).on("load", function () { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({'overflow': 'visible'});
    })


    /* -------------------------------------------------------------------------*
     * OWL CAROUSEL 
     * -------------------------------------------------------------------------*/

    // owl Main carousel script

    var owl = $("#owl-main");
    owl.owlCarousel({
        items: 1,
        autoplay: true,
        nav: false,
        dots: true,
        margin: 10,
        loop: true,
  
        autoplayTimeout:10000,
   
        smartSpeed: 100,
        animateIn: 'fadeIn',
        animateOut:'fadeOut',
        autoplayHoverPause: true
    });


    // owl Sync carousel script


    var $sync1 = $(".big-images"),
            $sync2 = $(".thumbs"),
            flag = false,
            duration = 300;

    $sync1
            .owlCarousel({
                items: 1,
                margin: 10,
                nav: false,
                autoplay: true,
                loop: false,
                dots: false
            })
			$('owl.carousel').on('change',function(e){    if (!flag) {
                    flag = true;
                    $sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }})
   

    $sync2
            .owlCarousel({
                margin: 20,
                items: 6,
                nav: false,
                autoplay: true,
                loop: false,
                dots: false
            })
       		
	$('.owl-item').on('click', function () {
				$sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
			})

	$('owl.carousel').on('change',function(e){
					 if (!flag) {
						flag = true;
						$sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
						flag = false;
					}
				})
       


    /* -------------------------------------------------------------------------*
     *  IMAGE CUSTOMIZATION SCRIPT
     * -------------------------------------------------------------------------*/
    document.createElement("picture");


    /* -------------------------------------------------------------------------*
     * Shopping: QUANTITY INCREMENT OR DECREMENT BUTTON
     * -------------------------------------------------------------------------*/
    $(".qty-btngroup").each(function () {
        var a = $(this),
                b = a.children('input[type="text"]'),
                c = b.val();

        a.children(".plus").on("click", function () {
            b.val(++c);
        }), a.children(".minus").on("click", function () {
            0 != c && b.val(--c)
        })
    }),
            /* -------------------------------------------------------------------------*
             * WEATHER SECTION 
             * -------------------------------------------------------------------------*/

            $.simpleWeather({
                location: 'Cairo',
                woeid: '',
                unit: 'f',
                success: function (weather) {
                    var html = '<h2><i class="icon-' + weather.code + '"></i> ' + weather.temp + '&deg;' + weather.units.temp + '</h2>';
                    html += '<ul><li>' + weather.city + ' - ' + weather.country + '</li>';
                    // html += '<li class="currently">' + weather.currently + '</li>';
                    // html += '<li>' + weather.wind.direction + ' ' + weather.wind.speed + ' ' + weather.units.speed + '</li></ul>';

                    $("#weather").html(html);
                },
                error: function (error) {
                    $("#weather").html('<p>' + error + '</p>');
                }
            });
    //]]>
    /* -------------------------------------------------------------------------*
     * STYLE SWITCHER
     * -------------------------------------------------------------------------*/
    $('#switcher').styleSwitcher({
        useCookie: true
    });
    /* -------------------------------------------------------------------------*
     * Shopping: Price Slider
     * -------------------------------------------------------------------------*/

    if ($("#price-slider").length > 0)
    {
        $("#price-slider").slider();
    }
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////

// thumbEffect
// bannerEffect
// 

    $('#custom-pattern1').on("click", function () {
        $('.bannerEffect').removeClass('svgoverlay2 svgoverlay3 svgoverlay4').addClass('svgoverlay1');
        $('.thumbEffect').removeClass('mask2 mask3 mask4').addClass('mask1'); });

     
    $('#custom-pattern2').on("click", function () {
        $('.bannerEffect').removeClass('svgoverlay1 svgoverlay3 svgoverlay4').addClass('svgoverlay2');
        $('.thumbEffect').removeClass('mask1 mask3 mask4').addClass('mask2');
    });
    $('#custom-pattern3').on("click", function () {
        $('.bannerEffect').removeClass('svgoverlay1 svgoverlay2 svgoverlay4').addClass('svgoverlay3');
        $('.thumbEffect').removeClass('mask1 mask2 mask4').addClass('mask3');
    });
    $('#custom-pattern4').on("click", function () {
        $('.bannerEffect').removeClass('svgoverlay1 svgoverlay2 svgoverlay3').addClass('svgoverlay4');
        $('.thumbEffect').removeClass('mask1 mask2 mask3').addClass('mask4');
    });

    $("#navMenu").click(function () {
        $('html, body').toggleClass("overflow");
    });

////////////////////////////////////////////////////////////////////////////////

  


});
