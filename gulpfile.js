var elixir = require('laravel-elixir');

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

elixir(function (mix) {

    mix.less(['main.less'], 'public/css/frontend');

    // css
    mix.stylesIn('resources/assets/shared/css', 'public/css/frontend/shared.css');

    mix.stylesIn("resources/assets/client/css", "public/css/frontend/libs.css");

    mix.stylesIn("public/css/backend", "public/css/backend/all.css");

    // combine
    mix.styles([
        "shared.css",
        "libs.css",
        "main.css"
    ], 'public/build/css/application.css', 'public/css/frontend');

    // js
    mix.scriptsIn("resources/assets/shared/js", 'public/js/frontend/shared.js');

    mix.scriptsIn("resources/assets/client/js/libs", "public/js/frontend/libs.js");

    mix.scriptsIn("resources/assets/client/js/custom", 'public/js/frontend/main.js');

    mix.scriptsIn("public/js/backend", "public/js/backend/all.js");

    mix.scripts([
        "shared.js",
        "lib.js",
        "main.js"
    ], 'public/build/js/application.js', 'public/js/frontend');

});