(function ($) {
    "use strict";

    $('.carousel').carousel();

    //$(".dropdown").hover(
    //    function() {
    //        $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("slow");
    //        $(this).toggleClass('open');
    //    },
    //    function() {
    //        $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("slow");
    //        $(this).toggleClass('open');
    //    }
    //);

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

    // scroll effect
    //$(document).ready(function() {
    //
    //    var header = $('#2cnd');
    //    header.scrollToFixed( { marginTop: 20} )
    //});

    var time = 10; // time in seconds

    var $progressBar,
        $bar,
        $elem,
        isPause,
        tick,
        percentTime;

    //Init the carousel
    $("#owl-main-slider").owlCarousel({
        slideSpeed : 500,
        paginationSpeed : 500,
        singleItem : true,
        afterInit : progressBar,
        afterMove : moved,
        startDragging : pauseOnDragging
    });

    //Init progressBar where elem is $("#owl-demo")
    function progressBar(elem){
        $elem = elem;
        //build progress bar elements
        buildProgressBar();
        //start counting
        start();
    }

    //create div#progressBar and div#bar then prepend to $("#owl-demo")
    function buildProgressBar(){
        $progressBar = $("<div>",{
            id:"progressBar"
        });
        $bar = $("<div>",{
            id:"bar"
        });
        $progressBar.append($bar).prependTo($elem);
    }

    function start() {
        //reset timer
        percentTime = 0;
        isPause = false;
        //run interval every 0.01 second
        tick = setInterval(interval, 10);
    };

    function interval() {
        if(isPause === false){
            percentTime += 1 / time;
            $bar.css({
                width: percentTime+"%"
            });
            //if percentTime is equal or greater than 100
            if(percentTime >= 100){
                //slide to next item
                $elem.trigger('owl.next')
            }
        }
    }

    //pause while dragging
    function pauseOnDragging(){
        isPause = true;
    }

    //moved callback
    function moved(){
        //clear interval
        clearTimeout(tick);
        //start again
        start();
    }

    // uncomment this to make pause on mouseover

    if($elem !== undefined){
        $elem.on('mouseover',function(){
            isPause = true;
        });
        $elem.on('mouseout',function(){
            isPause = false;
        });
    }

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

// lazy loading images
    $(document).ready(function () {
        echo.init({
            offset: 100,
            throttle: 250,
            unload: false
        });
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
        lensFadeOut: 500,
        cursor: "crosshair"
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
(function ($) {

    /*===================================================================================*/
    /*	OWL CAROUSEL
     /*===================================================================================*/
    $(document).ready(function () {
        var dragging = true;
        var owlElementID = "#owl-main";

        function fadeInReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").stop().delay(800).animate({opacity: 0}, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            }
            else {
                $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").css({opacity: 0});
            }
        }

        function fadeInDownReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").stop().delay(800).animate({
                    opacity: 0,
                    top: "-15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").css({
                    opacity: 0,
                    top: "-15px"
                });
            }
        }

        function fadeInUpReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").stop().delay(800).animate({
                    opacity: 0,
                    top: "15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").css({
                    opacity: 0,
                    top: "15px"
                });
            }
        }

        function fadeInLeftReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").stop().delay(800).animate({
                    opacity: 0,
                    left: "15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").css({
                    opacity: 0,
                    left: "15px"
                });
            }
        }

        function fadeInRightReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").stop().delay(800).animate({
                    opacity: 0,
                    left: "-15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").css({
                    opacity: 0,
                    left: "-15px"
                });
            }
        }

        function fadeIn() {
            $(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function fadeInDown() {
            $(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        function fadeInUp() {
            $(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        function fadeInLeft() {
            $(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        function fadeInRight() {
            $(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        $(owlElementID).owlCarousel({

            autoPlay: 5000,
            stopOnHover: true,
            navigation: true,
            pagination: true,
            singleItem: true,
            addClassActive: true,
            transitionStyle: "fade",
            navigationText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],

            afterInit: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            afterMove: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            afterUpdate: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            startDragging: function () {
                dragging = true;
            },

            afterAction: function () {
                fadeInReset();
                fadeInDownReset();
                fadeInUpReset();
                fadeInLeftReset();
                fadeInRightReset();
                dragging = false;
            }

        });

        if ($(owlElementID).hasClass("owl-one-item")) {
            $(owlElementID + ".owl-one-item").data('owlCarousel').destroy();
        }

        $(owlElementID + ".owl-one-item").owlCarousel({
            singleItem: true,
            navigation: false,
            pagination: false
        });

        $('#transitionType li a').click(function () {

            $('#transitionType li a').removeClass('active');
            $(this).addClass('active');

            var newValue = $(this).attr('data-transition-type');

            $(owlElementID).data("owlCarousel").transitionTypes(newValue);
            $(owlElementID).trigger("owl.next");

            return false;

        });


        $('.home-owl-carousel').each(function () {

            var owl = $(this);
            var itemPerLine = owl.data('item');
            if (!itemPerLine) {
                itemPerLine = 4;
            }
            owl.owlCarousel({
                items: itemPerLine,
                itemsTablet: [768, 2],
                navigation: true,
                pagination: false,

                navigationText: ["", ""]
            });
        });

        $(".blog-slider").owlCarousel({
            items: 3,

            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            navigation: true,
            slideSpeed: 300,
            pagination: false,
            navigationText: ["", ""]
        });

        $(".best-seller").owlCarousel({
            items: 3,
            navigation: true,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            slideSpeed: 300,
            pagination: false,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });

        $(".sidebar-carousel").owlCarousel({
            items: 1,
            itemsTablet: [768, 2],
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            navigation: true,
            slideSpeed: 300,
            pagination: false,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });

        $(".brand-slider").owlCarousel({
            items: 6,
            navigation: true,
            slideSpeed: 300,
            pagination: false,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });
        $("#advertisement").owlCarousel({
            items: 1,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            navigation: true,
            slideSpeed: 300,
            pagination: true,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });

        var $owl_controls_custom = $('.owl-controls-custom');
        $('.owl-next', $owl_controls_custom).click(function (event) {
            var selector = $(this).data('owl-selector');
            var owl = $(selector).data('owlCarousel');
            owl.next();
            return false;
        });
        $('.owl-prev', $owl_controls_custom).click(function (event) {
            var selector = $(this).data('owl-selector');
            var owl = $(selector).data('owlCarousel');
            owl.prev();
            return false;
        });

        $(".owl-next").click(function () {
            $($(this).data('target')).trigger('owl.next');
            return false;
        });

        $(".owl-prev").click(function () {
            $($(this).data('target')).trigger('owl.prev');
            return false;
        });

    });

})(jQuery);

/**
 * Created by Antony on 1/17/2015.
 */

(function ($) {
    // still trying to reuse validation logic...need help

    var icons = {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    };

    var commonFields = {
        email: {
            validators: {
                notEmpty: {
                    message: 'Please enter your email address'
                },
                emailAddress: {
                    message: 'Please enter a valid email address'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Please enter your password'
                },
                stringLength: {
                    min: 6,
                    max: 30,
                    message: 'Your password must be between 6 and 30 characters'
                }
            }
        },
        loginPassword: {
            validators: {
                notEmpty: {
                    message: 'Please enter your password'
                }
            }
        },
        password_confirmation: {
            validMessage: 'Good. The passwords match',
            validators: {
                notEmpty: {
                    message: 'Please repeat your password'
                },
                identical: {
                    field: 'password',
                    message: 'The passwords do not match'
                }
            }
        },
        comment: {
            notEmpty: {
                message: 'Please enter your comment'
            },
            stringLength: {
                min: 3,
                max: 500,
                message: 'your comment must be between 3 and 500 characters'
            }
        },
        stars: {
            notEmpty: {
                message: 'Please pick a star rating'
            }
        },
        first_name: {
            validators: {
                notEmpty: {
                    message: 'Please enter your first name'
                },
                stringLength: {
                    min: 3,
                    max: 20,
                    message: 'The name must be between 3 and 20 characters'
                },
                regexp: {
                    regexp: /^[a-z\s]+$/i,
                    message: 'The name can consist of alphabetical characters and spaces only'
                }
            }
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Please enter your last/second name'
                },
                stringLength: {
                    min: 3,
                    max: 20,
                    message: 'The name must be between 3 and 20 characters'
                },
                regexp: {
                    regexp: /^[a-z\s]+$/i,
                    message: 'The second name can consist of alphabetical characters and spaces only'
                }
            }
        },
        phone: {
            validators: {
                notEmpty: {
                    message: 'Please enter your phone number e.g 7123456789'
                },
                stringLength: {
                    min: 9,
                    max: 9,
                    message: 'Your phone number should consist of 9 digits'
                },
                numeric: {
                    lessThan: 9,
                    message: 'That is not a valid number'
                }
            }
        },
        town: {
            validators: {
                notEmpty: {
                    message: 'Please enter your hometown'
                },
                stringLength: {
                    min: 3,
                    max: 30,
                    message: 'The town name must be between 3 and 30 characters'
                },
                regexp: {
                    regexp: /^[a-z\s]+$/i,
                    message: 'The town name can consist of alphabetical characters and spaces only'
                }
            }
        },
        home_address: {
            validators: {
                notEmpty: {
                    message: 'Please enter your home address'
                },
                stringLength: {
                    min: 3,
                    max: 100,
                    message: 'The home address must be between 3 and 100 characters'
                }
            }
        }

    };

    var forms = {
        // login
        login: {
            email: commonFields.email,
            password: commonFields.loginPassword
        },

        // user registration
        registration: {
            first_name: commonFields.first_name,

            last_name: commonFields.last_name,
            phone: commonFields.phone,
            town: commonFields.town,
            email: commonFields.email,
            home_address: commonFields.home_address,
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation,

            accept: {
                validators: {
                    choice: {
                        min: 1,
                        message: 'Please accept the terms of agreement'
                    }
                }
            }
        },

        // requesting to reset a password
        forgot: {
            email: commonFields.email
        },

        // resetting a password
        resetPassword: {
            email: commonFields.email,
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation

        },

        // commenting on a product
        reviews: {
            comment: commonFields.comment,
            stars: commonFields.stars
        },

        // emailing a product
        emailProduct: {
            email: commonFields.email,
            comment: commonFields.comment
        },

        // checking out as a guest
        guestCheckout : {
            first_name: commonFields.first_name,
            last_name: commonFields.last_name,
            town: commonFields.town,
            home_address : commonFields.home_address,
            phone: commonFields.phone,
            email: commonFields.email

        },

        // editing the password, in the user profile section
        accountPasswordEdit:{
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation
        },

        // editing user contact information in their profile section
        contactInfoEdit: {
            phone: commonFields.phone,
            email: commonFields.email
        }

    };


    doValidate($('#loginForm'), forms.login);

    doValidate($('#registrationForm'), forms.registration);

    doValidate($('#resetPasswordForm'), forms.resetPassword);

    doValidate($('#forgotPassword'), forms.forgot);

    doValidate($('#reviewsForm'), forms.reviews);

    doValidate($('#productMailForm'), forms.emailProduct);

    doValidate($('#guestCheckoutForm'), forms.guestCheckout);

    doValidate($('#simplePasswordResetForm'), forms.accountPasswordEdit);

    doValidate($('#editContactInfo'), forms.contactInfoEdit);

    // the form validation function
    function doValidate(formID, formObject) {
        formID.formValidation({
            framework: 'bootstrap',
            icon: {
                valid: icons.valid,
                invalid: icons.invalid,
                validating: icons.validating
            },
            fields: formObject
        });
    }

})(jQuery);