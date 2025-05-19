const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),

       {
        "/css/app.css": "/css/app.css?id=xxxxxxxxxxxxxx",
        "/js/app.js"  : "/js/app.js?id=xxxxxxxxxxxxxx",
       }
   ])
   .version(); // Si vous voulez versionner les fichiers pour le cache-busting

   mix.css('resources/css/login.css', 'public/css');
