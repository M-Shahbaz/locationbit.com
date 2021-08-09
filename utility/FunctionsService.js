import {phone} from 'phone';

export const ucfirst = (str) => {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

export const plusfirst = (str) => {
    var firstLetter = str.substr(0, 1);
    if(firstLetter == "+"){
    	return str;
    }else{
        return "+" + str;
    }
}

export const getPhoneWithoutCountryCode = (phoneNumber) => {
    const phoneObject = phone(phoneNumber);
    if(phoneObject.isValid === true){
        return phoneObject.phoneNumber.replace(phoneObject.countryCode, '');
    }
    return phoneNumber;
}

export const getPhoneCountryIso2Code = (phoneNumber) => {
    const phoneObject = phone(phoneNumber);
    if(phoneObject.isValid === true){
        return phoneObject.countryIso2;
    }
    return null;
}