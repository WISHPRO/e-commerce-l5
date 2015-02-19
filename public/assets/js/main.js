(function ($) {
    "use strict";

    //$(function () {
    //    $(".dropdown").hover(
    //        function () {
    //            $('.dropdown-menu', this).stop(true, true).fadeIn();
    //            $(this).toggleClass('open');
    //
    //        },
    //        function () {
    //            $('.dropdown-menu', this).stop(true, true).fadeOut();
    //            $(this).toggleClass('open');
    //
    //        });
    //});

    /*===================================================================================*/
    /*  WOW 
     /*===================================================================================*/

    $(document).ready(function () {
        new WOW().init();
    });

    /*===================================================================================*/
    /*  OWL CAROUSEL
     /*===================================================================================*/

    //$(document).ready(function () {
    //
    //    $("#brands-slider").owlCarousel({
    //
    //        autoPlay: 10000, //Set AutoPlay to 3 seconds
    //
    //        items: 4,
    //        itemsDesktop: [1199, 3],
    //        itemsDesktopSmall: [979, 3]
    //
    //    });
    //
    //});

    $(document).ready(function () {

        $("#owl-main").owlCarousel({

            //navigation : true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: 5000,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]

            // "singleItem:true" is a shortcut for:
            // items : 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false

        });

        $(document).ready(function () {

            $("#owl-products").owlCarousel({

                autoPlay: 5000, //Set AutoPlay to 3 seconds

                items: 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]

            });

        });

    });


    /*===================================================================================*/
    /*  CUSTOM CONTROLS
     /*===================================================================================*/

    $(document).ready(function () {

        // Select Dropdown
        if ($('.le-select').length > 0) {
            $('.le-select select').customSelect({customClass: 'le-select-in'});
        }

        // Checkbox
        if ($('.le-checkbox').length > 0) {
            this.after('<i class="fake-box"></i>');
        }

        //Radio Button
        if ($('.le-radio').length > 0) {
            this.after('<i class="fake-box"></i>');
        }

        // Buttons
        $('.le-button.disabled').click(function (e) {
            e.preventDefault();
        });

        // Quantity Spinner
        $('.le-quantity a').click(function (e) {
            e.preventDefault();
            var currentQty = $(this).parent().parent().find('input').val();
            if ($(this).hasClass('minus') && currentQty > 0) {
                $(this).parent().parent().find('input').val(parseInt(currentQty, 10) - 1);
            } else {
                if ($(this).hasClass('plus')) {
                    $(this).parent().parent().find('input').val(parseInt(currentQty, 10) + 1);
                }
            }
        });

        // Price Slider
        if ($('.price-slider').length > 0) {
            this.slider({
                min: 100,
                max: 700,
                step: 10,
                value: [100, 400],
                handle: "square"

            });
        }

        // Data Placeholder for custom controls

        $('[data-placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('data-placeholder')) {
                input.val('');

            }
        }).blur(function () {
            var input = $(this);
            if (input.val() === '' || input.val() == input.attr('data-placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('data-placeholder'));
            }
        }).blur();

        $('[data-placeholder]').parents('form').submit(function () {
            $(this).find('[data-placeholder]').each(function () {
                var input = $(this);
                if (input.val() == input.attr('data-placeholder')) {
                    input.val('');
                }
            });
        });

    });



// lazy loading images
    $(document).ready(function () {
        echo.init({
            offset: 100,
            throttle: 250,
            unload: false
        });
    });

    /*===================================================================================*/
    /*  QUANTITY
     /*===================================================================================*/

    var action;
    $(".number-spinner button").mousedown(function () {
        var btn = $(this);
        var input = btn.closest('.number-spinner').find('input');
        btn.closest('.number-spinner').find('button').prop("disabled", false);

        if (btn.attr('data-dir') == 'up') {
            action = setInterval(function(){
                if ( input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max')) ) {
                    input.val(parseInt(input.val())+1);
                }else{
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
        } else {
            action = setInterval(function(){
                if ( input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min')) ) {
                    input.val(parseInt(input.val())-1);
                }else{
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
        }
    }).mouseup(function(){
        clearInterval(action);
    });

    /*===================================================================================*/
    /*  TOOLTIP
     /*===================================================================================*/
    $("[data-toggle='tooltip']").tooltip();

    $('#transitionType li a').click(function () {

        $('#transitionType li a').removeClass('active');
        $(this).addClass('active');

        var newValue = $(this).attr('data-transition-type');

        $(owlElementID).data("owlCarousel").transitionTypes(newValue);
        $(owlElementID).trigger("owl.next");

        return false;

    });


    $('[data-toggle="popover"]').popover();
    $('#flash-overlay-modal').modal();


    // zooming over product images
    $("#zoom_img").elevateZoom({
        scrollZoom : true,
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500
    });
    // maps section

    /*

     function initialize() {
     var mapProp = {
     center:new google.maps.LatLng(51.508742,-0.120850),
     zoom:5,
     mapTypeId:google.maps.MapTypeId.ROADMAP
     };
     var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
     }
     google.maps.event.addDomListener(window, 'load', initialize);

     */
    $(document).ready(function () {
        // check of the google maps script has been loaded
        if (typeof google === 'undefined') {
            return;
        }
        var zoom = 16;
        var latitude = -1.326259;
        var longitude = 36.709447;

        var mapProp = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        Initialize();

        function Initialize() {
            var map = new google.maps.Map(document.getElementById("map"), mapProp);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                animation: google.maps.Animation.BOUNCE,
                map: map
            });

            var mapIsNotActive = false;
        }
    });

    // character counter
    (function ($) {
        /**
         * attaches a character counter to each textarea element in the jQuery object
         * usage: $("#myTextArea").charCounter(max, settings);
         * http://bootsnipp.com/snippets/featured/message-box-with-counter
         */

        $.fn.charCounter = function (max, settings) {
            max = max || 100;
            settings = $.extend({
                container: "<span></span>",
                classname: "charcounter",
                format: "(%1 characters remaining)",
                pulse: true,
                delay: 0
            }, settings);
            var p, timeout;

            function count(el, container) {
                el = $(el);
                if (el.val().length > max) {
                    el.val(el.val().substring(0, max));
                    if (settings.pulse && !p) {
                        pulse(container, true);
                    }
                }
                if (settings.delay > 0) {
                    if (timeout) {
                        window.clearTimeout(timeout);
                    }
                    timeout = window.setTimeout(function () {
                        container.html(settings.format.replace(/%1/, (max - el.val().length)));
                    }, settings.delay);
                } else {
                    container.html(settings.format.replace(/%1/, (max - el.val().length)));
                }
            }

            function pulse(el, again) {
                if (p) {
                    window.clearTimeout(p);
                    p = null;
                }
                el.animate({opacity: 0.1}, 100, function () {
                    $(this).animate({opacity: 1.0}, 100);
                });
                if (again) {
                    p = window.setTimeout(function () {
                        pulse(el)
                    }, 200);
                }
            }

            return this.each(function () {
                var container;
                if (!settings.container.match(/^<.+>$/)) {
                    // use existing element to hold counter message
                    container = $(settings.container);
                } else {
                    // append element to hold counter message (clean up old element first)
                    $(this).next("." + settings.classname).remove();
                    container = $(settings.container)
                        .insertAfter(this)
                        .addClass(settings.classname);
                }
                $(this)
                    .unbind(".charCounter")
                    .bind("keydown.charCounter", function () {
                        count(this, container);
                    })
                    .bind("keypress.charCounter", function () {
                        count(this, container);
                    })
                    .bind("keyup.charCounter", function () {
                        count(this, container);
                    })
                    .bind("focus.charCounter", function () {
                        count(this, container);
                    })
                    .bind("mouseover.charCounter", function () {
                        count(this, container);
                    })
                    .bind("mouseout.charCounter", function () {
                        count(this, container);
                    })
                    .bind("paste.charCounter", function () {
                        var me = this;
                        setTimeout(function () {
                            count(me, container);
                        }, 10);
                    });
                if (this.addEventListener) {
                    this.addEventListener('input', function () {
                        count(this, container);
                    }, false);
                }
                count(this, container);
            });
        };

    })(jQuery);

    $(function () {
        $(".counted").charCounter(500, {container: "#counter"});
    });

    // currency convert
    var id = $('.sign');

    var rates = {
        usd: 87
    };

    function convert(id, to) {

        for (var i = 0; i < id.length, i++;) {
            var current = id[i].innerHTML;
            if (isNaN(parseFloat(current))) break;
            switch (to) {
                case "usd":
                    id[i].innerHTML = "$" + current / rates.usd;
                    break;
                case "ksh":
                {
                    id[i].innerHTML = "ksh" + rates.usd * current;
                    break;
                }
                default :
                {
                    id[i].innerHTML = "$" + current / rates.usd;
                }

            }
        }

    }

})(jQuery);