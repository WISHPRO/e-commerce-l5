/**
 * Created by Antony on 4/7/2015.
 */

(function ($) {
    "use strict";

    $(".deleteAction").submit(function (event) {

        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
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
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON;

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

/**
 * Created by Antony on 4/7/2015.
 */
(function ($) {
    "use strict";

    $(".updateAction").submit(function (event) {

        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
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
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON;

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

/**
 * Created by Antony on 4/7/2015.
 */
(function ($) {
    "use strict";

    $(".createAction").submit(function (event) {

        var form = $(event.target);
        var errors;
        var resultsHtml;
        var resultsDisplay = $('.msgDisplay');

        // hide the errors display
        setTimeout(function () {
            resultsDisplay.fadeOut()
        }, 10000);

        $.ajaxSetup({
            beforeSend: function () {
                // show image here
                $('.alt-ajax-image').show();
            },
            complete: function () {
                // hide image here
                $('.alt-ajax-image').hide();
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
                bootbox.alert('<i class=\"fa fa-check-square-o fa-3x b-box\">' + '</i>' + '&nbsp;<span class=\"bold\">' + response.message + '</span>', function () {
                    window.location.reload();
                });
            },

            error: function (data) {
                var errors = data.responseJSON;

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

//# sourceMappingURL=ajax.js.map