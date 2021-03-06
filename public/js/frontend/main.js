/**
 * Created by Antony on 3/28/2015.
 */
(function ($) {
    // character counter

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

    $(function () {
        $(".counted").charCounter(500, {container: "#counter"});
    });

})(jQuery);
/**
 * Created by Antony on 3/28/2015.
 */
(function ($) {

    // checkout progress steps display
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

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
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
/**
 * Created by Antony on 3/28/2015.
 */
(function ($) {
    // google maps
    $(document).ready(function () {
        // check of the google maps script has been loaded
        if (typeof google === 'undefined') {
            return;
        }
        var zoom = 16;
        // our office is in karen
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
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        new WOW().init();
    });

    // homepage slider
    $(document).ready(function () {

        $("#main-slider").owlCarousel({

            autoPlay: 5000,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true
        });

    });

    // auto close the flash notification
    setTimeout(function () {
        $('.flash-msg').fadeOut()
    }, 15000);

    // scroll effect

    //$(document).ready(function() {
    //
    //    var header = $('#2cnd');
    //    header.scrollToFixed( { marginTop: 20} )
    //});

    // lazy loading images
    $(document).ready(function () {
        echo.init({
            offset: 100,
            throttle: 250,
            unload: false
        });
    });

    // select 2 box
    $("#county-input").select2({
        placeholder: "select a county"
    });

    // initialize bootstrap carousel, tooltip, popover, modal
    $('.carousel').carousel();

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

    // img preview
    $(document).on('click', '#close-preview', function () {
        var img = $('.image-preview');
        img.popover('hide');
        // Hover before close the preview
        img.hover(
            function () {
                img.popover('show');
            },
            function () {
                img.popover('hide');
            }
        );
    });

    $(function () {
        // Create the close button
        var closebtn = $('<button/>', {
            type: "button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;'
        });
        closebtn.attr("class", "close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger: 'manual',
            html: true,
            title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
            content: "There's no image",
            placement: 'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function () {
            $('.image-preview').attr("data-content", "").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function () {
            var img = $('<img/>', {
                id: 'dynamic',
                width: 250,
                height: 200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
            };
            reader.readAsDataURL(file);
        });
    });

    // date time picker for account data
    $('.dateOfBirthDatetimePicker').datetimepicker(
        ({
            viewMode: 'years',
            format: 'YYYY-MM-DD'
        })
    );
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

/*
 * Sitewide Form validation
 *
 * */
(function ($) {

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
        },
        accept: {
            validators: {
                choice: {
                    min: 1,
                    message: 'Please accept the terms of agreement'
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
            accept: commonFields.accept
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
        guestCheckout: {
            first_name: commonFields.first_name,
            last_name: commonFields.last_name,
            town: commonFields.town,
            home_address: commonFields.home_address,
            phone: commonFields.phone,
            email: commonFields.email

        },

        // editing the password, in the user profile section
        accountPasswordEdit: {
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation
        },

        // editing user contact information in their profile section
        contactInfoEdit: {
            phone: commonFields.phone,
            email: commonFields.email
        }

    };


    //doValidate($('#loginForm'), forms.login);

    doValidate($('#registrationForm'), forms.registration);

    doValidate($('#resetPasswordForm'), forms.resetPassword);

    //doValidate($('#forgotPassword'), forms.forgot);

    //doValidate($('#reviewsForm'), forms.reviews);

    doValidate($('#productMailForm'), forms.emailProduct);

    doValidate($('#guestCheckoutForm'), forms.guestCheckout);

    //doValidate($('#simplePasswordResetForm'), forms.accountPasswordEdit);

    // doValidate($('#editContactInfo'), forms.contactInfoEdit);

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
(function ($) {
    "use strict";

    $(".editAccount").submit(function (event) {

        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        //var formData = form.serialize();
        //
        //formData.append("_token", $('[name=_token]').val());

        $.ajax({
            type: 'PATCH',
            url: form.attr('action'),
            data: form.serializeArray(),
            dataType: 'json',
            success: function (response) {

                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);
/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to add a product to their shopping cart using AJAX
 */
(function ($) {
    "use strict";

    // AJAX add to cart
    $(".addToCart").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.flash-msg');

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('#ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('#ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                swal({
                        title: "Success",
                        text: response.message,
                        type: "success",
                        showCancelButton: true,
                        cancelButtonText: "Keep shopping",
                        confirmButtonColor: "#3498db",
                        confirmButtonText: "View Shopping cart",
                        closeOnConfirm: true,
                        allowOutsideClick: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location.href = response.target;
                        } else {
                            location.reload();
                        }
                    }
                );
                //bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                //    window.location.href = response.target;
                //});
            },

            error: function (data) {
                var errors = data.responseJSON;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {

                    swal({
                            title: "Success",
                            text: errors,
                            type: "Error",
                            confirmButtonColor: "#3498db",
                            confirmButtonText: "Okay",
                            closeOnConfirm: true,
                            allowOutsideClick: false
                        }, function () {
                            location.reload();
                        }
                    );

                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);
/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to update their shopping cart via AJAX
 */
(function ($) {
    "use strict";

    // AJAX update cart
    $(".updateCart").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.flash-msg');

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('#ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('#ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'PATCH',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                swal({
                    title: "Success",
                    text: response.message,
                    type: "success",
                    confirmButtonColor: "#3498db",
                    confirmButtonText: "Okay",
                    closeOnConfirm: true,
                    allowOutsideClick: false
                }, function () {
                    location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON.message;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger m-t-10">' +
                    '<p class=\"bold\">' + "<i class=\"fa fa-cancel fa-3x b-box-error\"></i>" + '&nbsp;An error occured</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    bootbox.alert(resultsHtml);
                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });

    // remove from cart
    $(".removeFromCart").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.flash-msg');

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('#ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('#ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'DELETE',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                swal({
                    title: "Success",
                    text: response.message,
                    type: "success",
                    confirmButtonColor: "#3498db",
                    confirmButtonText: "Okay",
                    closeOnConfirm: true,
                    allowOutsideClick: false
                }, function () {
                    location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON.message;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });
})(jQuery);
/**
 * Created by Antony on 4/7/2015.
 */
(function ($) {
    "use strict";

    $(".submitCheckoutData").submit(function (event) {

        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                console.log(response.target);
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    response.target !== "undefined" ? window.location.href = response.target : window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON;
                if (data.status === 403) {
                    bootbox.alert('<i class=\"fa fa-close fa-3x b-box-error\">' + '</i>' + '&nbsp;<span class=\"bold\">' + "Access denied!" + '</span>', function () {

                    });
                }
                // laravel returns code 422 if validation fails
                else if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);

/**
 * Created by Antony on 4/7/2015.
 */
(function ($) {
    "use strict";

    $(".editCheckoutData").submit(function (event) {

        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'PATCH',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.href = response.target;
                });
            },

            error: function (data) {
                var errors = data.responseJSON;
                if (data.status === 403) {
                    bootbox.alert('<i class=\"fa fa-close fa-3x b-box-error\">' + '</i>' + '&nbsp;<span class=\"bold\">' + "Access denied!" + '</span>', function () {

                    });
                }
                // laravel returns code 422 if validation fails
                else if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);

/**
 * Created by Antony on 4/1/2015.
 */
(function ($) {
    "use strict";
    var errors;
    var resultsHtml;
    var resultsDisplay;

    $('#contact-form').submit(function (event) {

        resultsDisplay = $('#contactFormResult');
        var form = $(event.target);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('#ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('#ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
                setTimeout(function () {
                    $('#forgotPasswordModal').modal('hide')
                }, 5000);

            }
        });

        // process an email validation request
        $.ajax({

            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                // redirect user
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    location.reload();
                });
            },
            error: function (data) {
                // laravel sends validation errors as code 422
                if (data.status === 422) {

                    errors = data.responseJSON;

                    // scroll to the errors div
                    $('html, body').animate({
                        scrollTop: resultsDisplay.offset().top
                    }, 1000);
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger m-t-10">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<br/>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);

                } else {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger m-t-10">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);
/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to add product reviews via AJAX
 *
 */
(function ($) {
    "use strict";

    // AJAX reviews
    $(".addMyComment").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {
                    errors = data.responseJSON;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });
})(jQuery);
/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to add product reviews via AJAX
 *
 */
(function ($) {
    "use strict";

    // AJAX reviews
    $(".editMyComment").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.flash-msg');

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'PATCH',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON.message;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });
})(jQuery);
/**
 * Created by Antony on 3/31/2015.
 * Allows a user to search for a product
 */

(function ($) {

    "use strict";

    var btn = $('#s');
    var searchInputField = $("#searchInput");
    var form = $('#suggestiveSearch');

    // reject empty search queries
    btn.click(function (e) {
        if (!searchInputField.val().trim()) {
            searchInputField.focus();
            e.preventDefault();
        }
    });

    // show suggestions to the user as they type in the search box
    searchInputField.devbridgeAutocomplete({
        serviceUrl: form.attr('action'),
        paramName: 'q',
        minChars: 2,
        lookupLimit: 5,
        showNoSuggestionNotice: true,
        noSuggestionNotice: "No results were found",
        onSelect: function (suggestion) {
            searchInputField.innerHTML = suggestion.name;
            window.location.href = suggestion.redirect;
        }
    })

})(jQuery);
/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a customer to login via AJAX
 *
 */
(function ($) {
    "use strict";

    // Ajax customer login
    $('#loginForm').submit(function (event) {

        event.preventDefault();

        // get the form that was submitted
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('#login-form-ajax-result');
        // hide the errors display

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('#ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('#ajax-image').hide();

                $('input[name=password]').val('');

                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.toggleClass('wow bounceInUp');
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                // redirect user
                window.location.href = response.target;
            },
            error: function (data) {
                if (data.status === 401) {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
                // laravel sends validation errors as code 422
                if (data.status === 422) {
                    //process validation errors here.
                    errors = data.responseJSON;

                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger force-list-style m-t-10">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger force-list-style m-t-10">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });
    });


    // Ajax registration
    $('#registrationForm').submit(function (event) {

        event.preventDefault();

        // get the form that was submitted
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('#registration-form-ajax-result');
        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('#ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('#ajax-image').hide();

                $('input[name=password]').val('');
                $('input[name=password_confirmation]').val('');

                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                $('.ajax-image').hide();
                bootbox.alert('<p class=\"bold\">' + response.message + '</p>', function () {
                    window.location.href = response.target;
                });

            },
            error: function (data) {

                // scroll to the errors div
                $('html, body').animate({
                    scrollTop: resultsDisplay.offset().top
                }, 2000);

                // laravel sends validation errors as code 422
                if (data.status === 422) {
                    //process validation errors here.
                    errors = data.responseJSON;

                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);

                } else {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });
    });

})(jQuery);
/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to reset their password via AJAX
 */
(function ($) {
    "use strict";

    var errors;
    var resultsHtml;
    var resultsDisplay;

    $('#forgotPassword').submit(function (event) {

        resultsDisplay = $('#forgotPasswordAjax');
        var form = $(event.target);
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 5000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        // process an email validation request
        $.ajax({

            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {

                var msg = response.message;
                resultsHtml = '<div class="alert alert-info">' +
                '<p class=\"bold\">' + msg + '</p>' +
                '</div>';

                resultsDisplay.html(resultsHtml);

            },
            error: function (data) {
                // redisplay the errors input.
                resultsDisplay.fadeIn('fast');

                if (data.status === 404) {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
                // laravel sends validation errors as code 422
                if (data.status === 422) {

                    errors = data.responseJSON;

                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);

                } else {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }
        });

        event.preventDefault();
    });


    // process a password reset action
    $('#resetPasswordForms').submit(function (event) {

        resultsDisplay = $('#resetPasswordForm-ajax-result');
        var form = $(event.target);

        event.preventDefault();

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();

                $('input[name=password]').val('');
                $('input[name=password_confirmation]').val('');

                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
            }
        });

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                // redirect user
                bootbox.alert('<p class=\"bold\">' + response.message + '</p>', function () {
                    window.location.href = response.target;
                });
            },

            error: function (data) {
                if (data.status === 401) {
                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
                // laravel sends validation errors as code 422
                if (data.status === 422) {
                    //process validation errors here.
                    errors = data.responseJSON;

                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
                    '<p class=\"bold\">Please fix the following errors</p>' +
                    '<ul>';

                    // display all errors in this alert box
                    $.each(errors, function (key, value) {
                        resultsHtml += '<li>' + value[0] + '</li>';
                    });
                    resultsHtml += '</ul></div>';

                    // append the errors as html to the created element
                    resultsDisplay.html(resultsHtml);
                } else {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
            }

        });
    });

})(jQuery);