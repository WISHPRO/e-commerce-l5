(function ($) {
    "use strict";

    // reject empty search
    $(document).ready(function () {
        var btn = $('#s');
        btn.onclick = function () {
            var el = $("#mainSearchForm");
            if (!el.value.trim()) {
                el.focus();
                return false;
            }
        }

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

    // bootstrap carousel, tooltip, popover, modal
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

})(jQuery);