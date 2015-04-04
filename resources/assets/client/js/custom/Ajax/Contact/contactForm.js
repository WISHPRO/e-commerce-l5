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
            beforeSend:function(){
                // show image here
                $('#ajax-image').show();
            },
            complete:function(){
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
                bootbox.alert('<p class=\"bold\">'+response.message+'</p>', function() {
                    location.reload();
                });
            },
            error: function (data) {
                // laravel sends validation errors as code 422
                if (data.status === 422) {

                    errors = data.responseJSON;

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
                    bootbox.alert(resultsDisplay.html(resultsHtml), function(){});

                } else {

                    errors = data.responseJSON.message;
                    resultsHtml = '<div class="alert alert-danger m-t-10">' + errors + '</div>';
                    bootbox.alert(resultsDisplay.html(resultsHtml), function(){});
                }
            }
        });

        event.preventDefault();
    });

})(jQuery);