{!! HTML::script('assets/js/vendor/jquery/jquery-2.1.3.min.js') !!}
{!! HTML::script('assets/js/vendor/bootstrap/bootstrap.min.js') !!}
<script>
    // initialize bootstrap pop over and tooltip
    (function(JQuery){
        $("[data-toggle='tooltip']").tooltip();
        $('[data-toggle="popover"]').popover();
    })();

</script>