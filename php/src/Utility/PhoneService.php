<?php

namespace App\Utility;
use UnexpectedValueException;


final class PhoneService
{
    public static function formatPhoneE164($phone, $country = null, $format = 'E164', array $remove_pre = []): string 
    {
        $country = $country ?? APP_DEFAULT_COUNTRY;
        $country = strtoupper($country);

        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $countryNumberProto = $phoneUtil->parse($phone, $country);
        } catch (\libphonenumber\NumberParseException $e) {
            throw new UnexpectedValueException($e->getMessage());
        }
        
        if ( ! $phoneUtil->isValidNumber($countryNumberProto) ) {
            throw new UnexpectedValueException('Phone not valid!');
        }

        //E.164 international telephone number format [country code][area code][phone number]
        //https://support.plivo.com/support/solutions/articles/17000042303-do-i-need-to-add-country-code-while-dialling-out-
        $phone = $phoneUtil->format($countryNumberProto, \libphonenumber\PhoneNumberFormat::E164);
        
        $tmp_nr = $phone;

        foreach($remove_pre as $rmv){
            $length = strlen($rmv);
            if(substr($phone, 0, $length) == $rmv)
                $tmp_nr = substr($phone, $length);
        }

        return $tmp_nr;

    }

    public static function _formatPhoneNumber($number, $countrycode = null, $format = 'E164', array $remove_pre = []){
        $countrycode = $countrycode ?: APP_DEFAULT_COUNTRY;
        $utils = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $nr = $utils->parse($number, $countrycode);
            $new_number = $utils->format($nr, $format);
            $tmp_nr = $new_number;
            foreach($remove_pre as $rmv){
                $length = strlen($rmv);
                if(substr($new_number, 0, $length) == $rmv)
                    $tmp_nr = substr($new_number, $length);
            }
            return $tmp_nr;
        }
        catch (\libphonenumber\NumberParseException $e) {
            return $e;
        }
    }

    public static function validatePhoneNumber($number, $countrycode = null){
        $countrycode = $countrycode ?: PHONE_DEFAULT_COUNTRY;
        $res = array();
        $utils = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            return $utils->isValidNumber($utils->parse($number, $countrycode));
        }
        catch (\libphonenumber\NumberParseException $e) {
            return false; //$e->getMessage();
        }
    }

    public static function getCountryCodeFromNumber($number){
        $number = ltrim($number, '0');
        $number = preg_replace('~\D~', '', $number);
        if(substr( $number, 0, 2 ) === '49'){
            $country_code = 'DE';
        } else if(substr( $number, 0, 2 ) === '33'){
            $country_code = 'FR';
        } else if(substr( $number, 0, 2 ) === '39'){
            $country_code = 'IT';
        } else{
            $country_code = APP_DEFAULT_COUNTRY;
        }

        return $country_code;
    }

    public static function callCosts($to, $duration_sec, $plivo_rate, $direction, $foreign_rate_factor = 1.35){

        $plivo_rate = (float)$plivo_rate;
        $price = (object)array('cost'=>0.00,'rate'=>0.00,'conn_fee'=>0.00);
        $durationMints = FunctionsService::divide($duration_sec,60);

        if($direction == 'outbound' && substr($to, 0, 2) != PHONE_DEFAULT_COUNTRY_CODE){
            $price->rate = $plivo_rate < PHONE_RATE_CALL_FOREIGN ? PHONE_RATE_CALL_FOREIGN : ($plivo_rate * $foreign_rate_factor) ;
            $price->cost = number_format(($price->rate * $durationMints), 2, '.', '');
            $price->conn_fee = PHONE_RATE_CALL_PRE * $foreign_rate_factor;
        }
        else if($direction == 'outbound' && in_array(substr($to, 0, 4), PHONE_MOBILE_NUMBER_PREFIXES)) {
            $price->rate = $plivo_rate < PHONE_RATE_CALL_MOBILE ? PHONE_RATE_CALL_MOBILE : $plivo_rate;
            $price->cost = number_format(($price->rate * $durationMints), 2, '.', '');
            $price->conn_fee = PHONE_RATE_CALL_PRE;
        }
        else if($direction == 'outbound' && !in_array(substr($to, 0, 4), PHONE_MOBILE_NUMBER_PREFIXES)) {
            $price->rate = $plivo_rate < PHONE_RATE_CALL_LANDLINE ? PHONE_RATE_CALL_LANDLINE : $plivo_rate;
            $price->cost = number_format(($price->rate * $durationMints), 2, '.', '');
            $price->conn_fee = PHONE_RATE_CALL_PRE;
        }
        return  $price;
    }

}