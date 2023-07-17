import _ from "lodash";
window._ = _;

import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

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
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

window.getNumberTimeHM = () => {
    const now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    return Number(hours.toString() + minutes.toString());
};

Date.prototype.getDayOfYear = function() {
    var start = new Date(this.getFullYear(), 0, 0);
    var diff = this - start;
    var oneDay = 1000 * 60 * 60 * 24;
    var dayOfYear = Math.floor(diff / oneDay);
    return dayOfYear;
  };

  Date.prototype.getShortDayOfWeek = function() {
    var options = { weekday: 'short' };
    return this.toLocaleString('uk-UA', options);
  }

  Date.prototype.getDaysInCurrentMonth = function () {
    // Поверне кількість днів для поточного місяця.
    var year = this.getFullYear(); // Рік
    var month = this.getMonth(); // Місяць (0-11)

    // Отримання дати першого дня наступного місяця
    var firstDayOfNextMonth = new Date(year, month + 1, 1);

    // Отримання дати останнього дня поточного місяця
    var lastDayOfCurrentMonth = new Date(firstDayOfNextMonth - 1);

    // Отримання числа останнього дня поточного місяця
    var daysInCurrentMonth = lastDayOfCurrentMonth.getDate();

    return daysInCurrentMonth;
  }

  Date.prototype.getTodaysDate = function () {
    // Метод поверне дату у форматі рік-місяць-день
    const year = this.getFullYear();
    const month = this.getMonth() + 1; // 0-indexed, so add 1
    const day = this.getDate();

    return `${year}-${month}-${day}`;
  }
