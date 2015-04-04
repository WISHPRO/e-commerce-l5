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
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 5000);

        $.ajaxSetup({
            beforeSend:function(){
                // show image here
                $('#ajax-image').show();
            },
            complete:function(){
                // hide image here
                $('#ajax-image').hide();

                $('input[name=password]').val('');

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
            beforeSend:function(){
                // show image here
                $('#ajax-image').show();
            },
            complete:function(){
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
                bootbox.alert('<p class=\"bold\">'+response.message+'</p>', function() {
                    window.location.href = response.target;
                });

            },
            error: function (data) {
                $('.ajax-image').hide();

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