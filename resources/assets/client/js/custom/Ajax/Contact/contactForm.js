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

        resultsDisplay.fadeIn('fast');

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

                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function (data) {

                // redisplay the errors input.
                resultsDisplay.fadeIn('fast');

                // laravel sends validation errors as code 422
                if (data.status === 422) {

                    errors = data.responseJSON;

                    // build a small bootstrap alert box
                    resultsHtml = '<div class="alert alert-danger">' +
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
                    resultsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    resultsDisplay.html(resultsHtml);
                }
                setTimeout(function () {
                    resultsDisplay.fadeOut()
                }, 15000);
            }
        });

        event.preventDefault();
    });

})(jQuery);