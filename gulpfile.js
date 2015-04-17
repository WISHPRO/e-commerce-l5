var elixir = require("laravel-elixir");

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;

elixir(function (mix) {

    var bowerAssetsDir = "resources/assets/bower_components/";

    mix.less(['general.less'], 'public/css/backend');

    mix.less(['main.less'], 'public/css/frontend');

    mix.less(['backend/backend.less'], 'public/css/backend');

    mix.less(['mail.less'], 'public/css/mail');


    // styles
    mix.styles([
        // bootstrap
        "bootstrap/dist/css/bootstrap.min.css",

        // animate
        "animate.css/animate.css",

        // bootstrap rating
        "bootstrap-rating/bootstrap-rating.css",

        // bootstrap table
        "bootstrap-table/dist/bootstrap-table.min.css",

        // datetime picker
        "eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css",

        // font awesome
        "font-awesome/css/font-awesome.min.css",

        // form validation
        "formvalidation/dist/css/formValidation.css",

        // owl
        "owl-carousel2/dist/assets/owl.carousel.css",
        "owl-carousel2/dist/assets/owl.theme.css",
        "owl-carousel2/dist/assets/owl.transitions.css",

        // lightbox
        "lightbox2/css/lightbox-custom.css",

        // select2
        "select2/select2.css"

    ], "public/css/frontend/libs.css", bowerAssetsDir);

    // copy font awesome & bootstrap fonts
    mix.copy(bowerAssetsDir + 'font-awesome/fonts', 'public/css/fonts');

    mix.copy(bowerAssetsDir + 'bootstrap/fonts', 'public/css/fonts');

    // scripts
    mix.scriptsIn("resources/assets/js/custom", "public/js/frontend/main.js");

    mix.scriptsIn("public/js/backend/ajax", "public/js/backend/ajax.js");

    mix.scripts([
        // jquery
        "jquery/dist/jquery.js",

        // bootstrap
        "bootstrap/dist/js/bootstrap.min.js",

        // hover dropdown
        "bootstrap-hover-dropdown/bootstrap-hover-dropdown.js",

        // moment
        "moment/min/moment.min.js",

        // bootbox
        "bootbox/bootbox.js",

        // scroll to fixed
        //"ScrollToFixed/jquery-scrolltofixed.js",

        // select2
        "select2/select2.js",

        // wow
        "WOW/dist/wow.min.js",

        // owl
        "owl-carousel2/dist/owl.carousel.js",

        // lightbox
        "lightbox2/js/lightbox.js",

        // summernote
        'summernote/dist/summernote.js',

        // validation
        "formvalidation/dist/js/formValidation.js",
        "formvalidation/dist/js/framework/bootstrap.js",

        // table
        "bootstrap-table/dist/bootstrap-table.min.js",

        // date time picker
        "eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js",

        // autocomplete
        "devbridge-autocomplete/dist/jquery.autocomplete.js",

        //dropzone
        "dropzone/downloads/dropzone.js",

        // echo
        "echojs/dist/echo.js",

        // zoom
        "elevatezoom/jquery.elevatezoom.js",

        // show password
        "bootstrap-show-password/bootstrap-show-password.js",

        // rating
        "bootstrap-rating/bootstrap-rating.js"

    ], "public/js/frontend/libs.js", bowerAssetsDir);


    mix.scriptsIn('public/js/backend', 'public/js/backend/site-backend.js');

    mix.scriptsIn('public/js/frontend', 'public/js/frontend/site.js');

    mix.styles([
        "datatables-bootstrap3/BS3/assets/css/datatables.css",

        "summernote/dist/summernote.css"

    ], "public/css/backend/all.css", bowerAssetsDir);

});