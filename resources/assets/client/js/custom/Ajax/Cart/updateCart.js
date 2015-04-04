/**
 * Created by Antony on 4/1/2015.
 *
 * Allows a user to update their shopping cart via AJAX
 */
(function ($) {
    "use strict";

    // AJAX update cart
    $(".updateCart").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.flash-msg');

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
            }
        });

        $.ajax({
            type: 'PATCH',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                bootbox.alert('<p class=\"bold\">'+response.message+'</p>', function() {
                    location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON.message;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
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

    // remove from cart
    $(".removeFromCart").submit(function (event) {

        // get the form that was submitted, since we have so many 'add to cart' forms in our page
        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.flash-msg');

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
            }
        });

        $.ajax({
            type: 'DELETE',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                //console.log(response.message);
                bootbox.alert('<p class=\"bold\">'+response.message+'</p>', function() {
                    location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON.message;

                // laravel returns code 422 if validation fails
                if (data.status === 422) {
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
})(jQuery);