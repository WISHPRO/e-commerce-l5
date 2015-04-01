/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to add a product to their shopping cart using AJAX
 */
(function ($) {
    "use strict";

    $('.loading-image').hide();

    // AJAX add to cart
    $(".addToCart").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {

                //console.log(response.message);

                bootbox.success(response, function() {
                    console.log("Alert Callback");
                });

            },

            error: function (data) {
                var errors = data.responseJSON.message;

                $('.loading-image').hide();
                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    //process validation errors here.
                    bootbox.error(data, function(){
                        console.log(errors)
                    });
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);