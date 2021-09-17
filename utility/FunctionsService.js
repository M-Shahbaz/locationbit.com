import { phone } from 'phone';

export const ucfirst = (str) => {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

export const plusfirst = (str) => {
    var firstLetter = str.substr(0, 1);
    if (firstLetter == "+") {
        return str;
    } else {
        return "+" + str;
    }
}

export const getPhoneWithoutCountryCode = (phoneNumber) => {
    const phoneObject = phone(phoneNumber);
    if (phoneObject.isValid === true) {
        return phoneObject.phoneNumber.replace(phoneObject.countryCode, '');
    }
    return phoneNumber;
}

export const getPhoneCountryIso2Code = (phoneNumber) => {
    const phoneObject = phone(phoneNumber);
    if (phoneObject.isValid === true) {
        return phoneObject.countryIso2;
    }
    return null;
}

export const time24to12Convert = (time) => {
    // Check correct time format and split into components
    time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

    if (time.length > 1) { // If time format correct
        time = time.slice(1); // Remove full string match value
        time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
        time[0] = +time[0] % 12 || 12; // Adjust hours
    }
    return time.join(''); // return adjusted time or original string
}

export const truncate = (input, length) => input.length > length ? `${input.substring(0, length)}...` : input;


export const camelToTitle = (text) => {
    const result = text.replace(/([A-Z])/g, " $1");
    const finalResult = result.charAt(0).toUpperCase() + result.slice(1);
    return finalResult;
}