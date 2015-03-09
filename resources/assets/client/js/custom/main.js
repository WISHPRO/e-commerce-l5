(function ($) {
    "use strict";

    // reject empty search
    $(document).ready(function () {
        var btn = $('#s');
        btn.onclick = function(){
            var el = $("#mainSearchForm");
            if (!el.value.trim()) {
                el.focus();
                return false;
            }
        }

    });

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

    // scroll effect
    //$(document).ready(function() {
    //
    //    var header = $('#2cnd');
    //    header.scrollToFixed( { marginTop: 20} )
    //});

    // homepage slider
    var c = $('#myCarousel');
    c.carousel({
        interval: 10000
    });

    var clickEvent = false;
    c.on('click', '.nav a', function () {
        clickEvent = true;
        $('.nav li').removeClass('active');
        $(this).parent().addClass('active');
    }).on('slid.bs.carousel', function (e) {
        if (!clickEvent) {
            var count = $('.nav').children().length - 1;
            var current = $('.nav li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if (count == id) {
                $('.nav li').first().addClass('active');
            }
        }
        clickEvent = false;
    });

    // grid/list
    $(document).ready(function () {
        $('#list').click(function (event) {
            event.preventDefault();
            $('#list-container').addClass('list-group-item');
        });
        $('#grid').click(function (event) {
            event.preventDefault();
            $('#grid-container').removeClass('list-group-item');
            $('#grid-container').addClass('grid-group-item');
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
            action = setInterval(function () {
                if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {
                    input.val(parseInt(input.val()) + 1);
                } else {
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
        } else {
            action = setInterval(function () {
                if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {
                    input.val(parseInt(input.val()) - 1);
                } else {
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
        }
    }).mouseup(function () {
        clearInterval(action);
    });

    /*===================================================================================*/
    /*  TOOLTIP
     /*===================================================================================*/
    $("[data-toggle='tooltip']").tooltip();

    $('[data-toggle="popover"]').popover();
    $('#flash-overlay-modal').modal();

    // zooming over product images
    $("#zoom_img").elevateZoom({
        scrollZoom: true,
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500
    });
    // maps section

    // google maps
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

    // checkout
    $(document).ready(function () {

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });

})(jQuery);