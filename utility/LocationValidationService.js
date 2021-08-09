import axios from 'axios'
import validator from 'validator';
import {phone} from 'phone';
import { Country, State, City } from 'country-state-city';

export const validatePhone = (phoneNumber, countryCode) => {

  const phoneValidation = phone(phoneNumber, {country: countryCode});

  const phoneValidated = phoneValidation.isValid === true ? phoneValidation.phoneNumber : null;
  
  console.log(phoneValidated);
  return phoneValidated;
}

export const validatePhoneWithCountryCode = (phoneNumber, countryCode) => {

  const phoneValidation = phone(phoneNumber, {country: countryCode});

  const phoneValidated = phoneValidation.isValid === true ? phoneValidation.phoneNumber : null;
  
  console.log(phoneValidated);
  return phoneValidated;
}

export const validatePhoneE164 = (phoneNumber) => {

  const phoneValidation = phone(phoneNumber);

  const phoneValidated = phoneValidation.isValid === true ? phoneValidation.phoneNumber : null;
  
  console.log(phoneValidated);
  return phoneValidated;
}