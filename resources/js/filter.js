import moment from "moment"
moment.locale('fr');
import Vue from "vue"

Vue.filter('capitalize', function (value, ...params) {
    console.info({value, params});
    if (!value) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1)
});


Vue.filter('date', function (value, params) {
    let date = moment.unix(value);
    console.log({date});
    if (! params) {
        return date.fromNow();
    }
    return date.format(params);
});

Vue.filter('notifNumbre', function (value) {
    if(value < 2) return value+" Notification";
    return value+" Notifications";
});
