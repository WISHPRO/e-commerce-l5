/**
 * Created by Antony on 3/28/2015.
 */
(function ($) {
    "use strict";

    // AJAX add to cart
    $(".addToCart").submit(function (event) {

        // get the form that was submitted
        var form = $(event.target);

        var outputHtml;

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

            error: function (data) { // the data parameter here is a jqXHR instance
                var errors = data.responseJSON.message;
                //console.log('server errors', errors);

                $('.loading-image').hide();
                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    //process validation errors here.

                    outputHtml = '<div class="alert alert-danger"><ul>';

                    $.each(errors, function (key, value) {
                        outputHtml += '<li>' + value + '</li>';
                    });
                    outputHtml += '</ul></div>';

                    $('.form-ajax-result').html(outputHtml);
                }
            }
        });

        event.preventDefault();
    });

    // Ajax customer login
    //$('#loginForm').submit(function (event) {
    //
    //    setTimeout(function() {
    //        $("#login-form-ajax-result").hide('blind', {}, 500)
    //    }, 5000);
    //
    //    event.preventDefault();
    //
    //    // get the form that was submitted
    //    var form = $(event.target);
    //    var errors;
    //    var errorsHtml;
    //
    //    $.ajax({
    //        type: 'POST',
    //        url: form.attr('action'),
    //        data: form.serialize(),
    //        dataType: 'json',
    //
    //        success: function(response){
    //            alert(response);
    //            $( location ).prop( 'pathname', response.target );
    //        },
    //        error: function (data) {
    //
    //            if (data.status === 401) {//redirect if not authenticated user
    //
    //                errors = data.responseJSON.message;
    //                errorsHtml = '<div class="alert alert-danger">' + errors + '</div>';
    //                $('#login-form-ajax-result').html(errorsHtml);
    //            }
    //            if (data.status === 422) {
    //                //process validation errors here.
    //                errors = data.responseJSON;
    //
    //                errorsHtml = '<div class="alert alert-danger">' +
    //                '<p class=\"bold\">Please fix the following errors</p>' +
    //                '<ul>';
    //
    //                $.each(errors, function (key, value) {
    //                    errorsHtml += '<li>' + value[0] + '</li>';
    //                });
    //                errorsHtml += '</ul></div>';
    //
    //                $('#login-form-ajax-result').html(errorsHtml);
    //            } else {
    //
    //            }
    //        }
    //    });
    //})

})(jQuery);