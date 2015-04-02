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
        var btn = $('#sendPassword').button('wait');
        var form = $(event.target);
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 5000);

        // process an email validation request
        $.ajax({

            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {

                btn.button('reset');
                var msg = response.message;
                resultsHtml = '<div class="alert alert-info">' +
                '<p class=\"bold\">' + msg + '</p>' +
                '</div>';

                resultsDisplay.html(resultsHtml);

                // close the modal
                setTimeout(function () {
                    $('#forgotPasswordModal').modal('hide')
                }, 5000)
            },
            error: function (data) {
                btn.button('reset');

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

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                $('.loading-image').hide();
                // redirect user
                window.location.href = response.target;
            },

            error: function (data) {
                // hide the AJAX image
                $('.loading-image').hide();
                // redisplay the errors input. It wont be seen since it wont have any content
                resultsDisplay.fadeIn('fast');
                // clear the password fields
                $('input[name=password]').val('');
                $('input[name=password_confirmation]').val('');

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