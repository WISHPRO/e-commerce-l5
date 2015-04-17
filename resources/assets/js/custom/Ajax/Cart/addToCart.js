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
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box-success\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.href = response.target;
                });
            },

            error: function (data) {
                var errors = data.responseJSON;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger m-t-10">' +
                    '<p class=\"bold\">' + '<i class=\"fa fa-cancel fa-3x b-box-error\">' + '</i>' + '&nbsp;An error occured</p>' +
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

})(jQuery);