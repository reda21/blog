import Vue from "vue"

// Register a global custom directive called `v-focus`
Vue.directive('focus', {
    // When the bound element is inserted into the DOM...
    inserted: function (el) {
        // Focus the element
        el.focus()
    }
})

// Register a global custom directive called `v-focus`
Vue.directive('tab', {
    // When the bound element is inserted into the DOM...
    inserted: function (el) {
        let id = el.id;
        let hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab("show");
        $("#" + id + ".nav-tabs a").click(function (e) {
            $(this).tab("show");
            window.location.hash = this.hash;
        });
    }
})

Vue.directive('date', {
    inserted(el) {
        let start = "-100y";
        let end = '+0d' ;

        window.$(el).datepicker({
            format : "dd/mm/yyyy",
            startDate: start,
            endDate: end,
        });
    }
});
