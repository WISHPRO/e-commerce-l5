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

        $('.loading-image').show();

        // get the form that was submitted
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('#login-form-ajax-result');
        // hide the errors display
        setTimeout(function(){ resultsDisplay.fadeOut() }, 5000);

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function(response){
                $('.loading-image').hide();
                // redirect user
                window.location.href = response.target;
            },
            error: function (data) {

                // hide the AJAX image
                $('.loading-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
                // clear the password field
                $('input[name=password]').val('');

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