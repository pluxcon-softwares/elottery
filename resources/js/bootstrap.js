window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.moment = require('moment');

window.$ = jQuery = require('jquery');

//window.dt = require('datatables.net');

window.swal = require('sweetalert2');

// require( 'datatables.net-bs4' )();
// require( 'datatables.net-responsive-bs4' )();
// require( 'datatables.net-scroller-bs4' )();
// require( 'datatables.net-searchbuilder-bs4' )();
// require( 'datatables.net-searchpanes-bs4' )();
// require( 'datatables.net-select-bs4' )();

require ("admin-lte/plugins/jquery-ui/jquery-ui.min.js");

require ("admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js");

require ("admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js");

require ("admin-lte");


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
