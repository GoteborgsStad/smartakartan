// > Vendor

// jQuery
window.$ = require("jquery");
//window.jQuery = $;

// jQuery bridget
var jQueryBridget = require('jquery-bridget');

// Bootstrap
require('bootstrap');

// Masonry
var Masonry = require('masonry-layout');
jQueryBridget('masonry', Masonry, $);

// Promise
window.Promise = require('es6-promise').Promise;

// Axios
window.axios = require('axios');

// Leaflet
window.L = require('leaflet');
require('leaflet-gesture-handling');

// > Site
require('./js/home-map.js');
require('./js/map-page-map.js');
require('./js/map-single.js');

require('./js/scripts.js');
require('./js/wp_ajax-load-more.js');
require('./js/wp_filter-ajax.js');
require('./js/wp_ajax_calender.js');
require('./js/wp_filter-az-ajax.js');
require('./js/wp_sub-cat-filter-ajax.js');
require('./js/the_map.js');
require('./js/extended.js');
