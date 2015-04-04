(function ($) {

    // auto close the flash notification
    setTimeout(function () {
        $('.flash-msg').fadeOut()
    }, 15000);

    // hide the ajax image
    $('.loading-image').hide();

    $('#editor').summernote({height: 300});
    $('#editor_small').summernote({height: 300});

    $("[data-toggle='tooltip']").tooltip();
    $('[data-toggle="popover"]').popover();
    $('#flash-overlay-modal').modal();

    // select boxes
    $(".users-roles").select2({
        placeholder: "select a user"
    });

    $(".product-categories").select2({
        placeholder: "select a category"
    });

    $(".product-subcategories").select2({
        placeholder: "select a sub-category"
    });

    $(".product-brands").select2({
        placeholder: "select a manufacturer"
    });

    $(".roles-assignment").select2({
        placeholder: "select roles"
    });

    $(".permissions-assignment").select2({
        placeholder: "select permissions for this role"
    });

    $(".advert-products").select2({
        placeholder: "select a product"
    });

    $(".ads-mode").select2({
        placeholder: "how will the ad be represented?"
    });

    $(document).on('click', '#close-preview', function () {
        var img = $('.image-preview');
        img.popover('hide');
        // Hover before close the preview
        img.hover(
            function () {
                img.popover('show');
            },
            function () {
                img.popover('hide');
            }
        );
    });

    $(function () {
        // Create the close button
        var closebtn = $('<button/>', {
            type: "button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;'
        });
        closebtn.attr("class", "close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger: 'manual',
            html: true,
            title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
            content: "There's no image",
            placement: 'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function () {
            $('.image-preview').attr("data-content", "").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function () {
            var img = $('<img/>', {
                id: 'dynamic',
                width: 250,
                height: 200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
            };
            reader.readAsDataURL(file);
        });
    });

    $(document).ready(function () {
        $('#example').dataTable();
    });

    // search
    // search function
    var usersTable = $('#users-search');

    var productsTable = $('#products-search');

    search(usersTable);

    search(productsTable);

    function search(elementID) {
        var activeSystemClass = $('.list-group-item.active');

        elementID.keyup(function () {
            var that = this;
            // affect all table rows on in systems table
            var tableBody = $('.table-list-search tbody');
            var tableRowsClass = $('.table-list-search tbody tr');
            $('.search-sf').remove();
            tableRowsClass.each(function (i, val) {

                //Lower text for case insensitive
                var rowText = $(val).text().toLowerCase();
                var inputText = $(that).val().toLowerCase();
                if (inputText != '') {
                    $('.search-query-sf').remove();
                    tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
                }
                else {
                    $('.search-query-sf').remove();
                }

                if (rowText.indexOf(inputText) == -1) {
                    //hide rows
                    tableRowsClass.eq(i).hide();

                }
                else {
                    $('.search-sf').remove();
                    tableRowsClass.eq(i).show();
                }
            });
            //all tr elements are hidden
            if (tableRowsClass.children(':visible').length == 0) {
                tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
            }
        });
    }

    // ajax

    var countiesForm = $('#countiesAddForm');

    var countiesEditForm = $('#countiesEditForm');

    backendAjaxRequest('PATCH', countiesEditForm);

    backendAjaxRequest('POST', countiesForm);

    function backendAjaxRequest(method, form){

        form.submit(function (e) {

            var formData = form.serialize();

            var outputHtml;

            $('.loading-image').show();

            $.ajax({
                type: method,
                url: form.attr('action'),
                data: formData,
                dataType: 'json',

                success: function (response) {
                    //console.log(response.status);

                    $('.loading-image').hide();

                    //console.log(response.message);
                    var v = response.message;
                    outputHtml = '<div class="alert alert-info">'+v+'</div>';
                    $( '.form-ajax-result' ).html( outputHtml);

                },

                error: function (data) { // the data parameter here is a jqXHR instance
                    var errors = data.responseJSON.name;
                    //console.log('server errors', errors);

                    $('.loading-image').hide();
                    // laravel returns code 422 if validation fails
                    if( data.status === 422 ) {
                        //process validation errors here.

                        outputHtml = '<div class="alert alert-danger"><ul>';

                        $.each( errors , function( key, value ) {
                            outputHtml += '<li>' + value + '</li>';
                        });
                        outputHtml += '</ul></div>';

                        $( '.form-ajax-result' ).html( outputHtml);
                    }
                }
            });

            e.preventDefault();
        });

    }

})(jQuery);
