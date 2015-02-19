(function ($) {


    $('#data').DataTable();


    $('#editor').summernote({height: 300});
    $('#editor_small').summernote({height: 300});

    $("[data-toggle='tooltip']").tooltip();
    $('[data-toggle="popover"]').popover();
    $('#flash-overlay-modal').modal();

})(jQuery);
