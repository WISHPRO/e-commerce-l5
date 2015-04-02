/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to update their product reviews using AJAX
 */
(function ($) {
    "use strict";

    // AJAX edit review
    $('#reviewsForm').submit(function (event) {

        var form = $(event.target);

        $.ajax({
            type: 'PATCH',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {

                //console.log(response.message);

                bootbox.success(response, function () {
                    console.log("Alert Callback");
                });

            },

            error: function (data) {
                var errors = data.responseJSON.message;

                $('.loading-image').hide();
                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    //process validation errors here.
                    bootbox.error(data, function () {
                        console.log(errors)
                    });
                }
            }
        });

        event.preventDefault();


    });

})(jQuery);