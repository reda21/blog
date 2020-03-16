import {extend, localize} from "vee-validate";
import {min, required, email, alpha} from "vee-validate/dist/rules";


import fr from "vee-validate/dist/locale/fr.json";
import en from "vee-validate/dist/locale/en.json"

// Install rules
extend("required", required);
extend("min", min);
extend("email", email);
extend("alpha", alpha);

extend('positive', (value) => {
    if (value >= 0) {
        return true;
    }

    return 'This value must be a positive number';
});
//date_format
extend('date_format', {
    validate(value, {format}) {
        return moment(value, format).isValid();
    },
    params: ['format'],
    message: 'Le champ {_field_} doit être au format {format}'
});
//date_between
extend('date_between', {
    validate(value, { min, max }) {
        let date = moment(value, "DD/MM/YYYY");
        let startDate = moment(min, "DD/MM/YYYY");
        let endDate = moment(max, "DD/MM/YYYY");
        return date.isBefore(endDate) && date.isAfter(startDate) || (date.isSame(startDate) || date.isSame(endDate))
    },
    params: ['min', 'max'],
    message: 'The {_field_} field must have at least {min} characters and {max} characters at most'
});

// Install messages
localize({
    en: fr
});


