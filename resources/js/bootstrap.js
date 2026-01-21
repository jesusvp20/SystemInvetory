import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let activeRequests = 0;
function inc() {
    activeRequests += 1;
    if (window.loaderUtils && activeRequests > 0) window.loaderUtils.showGlobal();
}
function dec() {
    activeRequests = Math.max(0, activeRequests - 1);
    if (window.loaderUtils && activeRequests === 0) window.loaderUtils.hideGlobal();
}
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
axios.interceptors.request.use(config => {
    const skip = config.headers && (config.headers['X-Background-Ping'] || config.headers['X-Skip-Loader']);
    if (!skip) inc();
    config.timeout = config.timeout ?? 8000;
    return config;
});
axios.interceptors.response.use(
    response => {
        dec();
        return response;
    },
    async error => {
        dec();
        const config = error.config || {};
        const status = error.response ? error.response.status : null;
        const isTimeout = error.code === 'ECONNABORTED';
        const retriable = isTimeout || status === 502 || status === 503 || status === 504;
        const skip = config.headers && (config.headers['X-Background-Ping'] || config.headers['X-Skip-Loader']);
        if (!retriable || skip) throw error;
        config.__retryCount = (config.__retryCount || 0) + 1;
        if (config.__retryCount > 3) throw error;
        const backoff = [500, 1500, 3000][config.__retryCount - 1] || 3000;
        if (window.loaderUtils) window.loaderUtils.showGlobal();
        await delay(backoff);
        if (window.loaderUtils) window.loaderUtils.hideGlobal();
        return axios(config);
    }
);
function ping() {
    axios.get('/up', { headers: { 'X-Background-Ping': '1' }, timeout: 4000 }).catch(() => {});
}
if (typeof window !== 'undefined') {
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        ping();
    } else {
        window.addEventListener('DOMContentLoaded', ping);
    }
    setInterval(ping, 12 * 60 * 1000);
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
