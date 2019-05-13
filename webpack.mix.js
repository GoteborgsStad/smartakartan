const mix = require('laravel-mix');

mix.sass('./assets/scss/main.scss', 'dist')
   .styles([
      'dist/main.css',
      'assets/css/vendor/font-awesome.min.css',
      'assets/css/vendor/leaflet.css',
      'assets/css/vendor/leaflet-gesture-handling.min.css',
   ], 'dist/all.css')
   .js('./assets/index.js', 'dist');
