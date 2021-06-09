<?php

namespace App\Utility;

final class EncryptionService
{
    public static function crypt($string, $action = 'encrypt', $secret_key = null)
    {
        // you may change these values to your own
        $secret_key = $secret_key ?: getenv('ENC_SECRET');
        $secret_iv = getenv('ENC_IV_SECRET');

        $output = false;
        $encrypt_method = getenv('ENC_METHOD');
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public static function cryptAES($string, $key, $iv, $action = 'encrypt')
    {
        $key = hex2bin($key);
        $iv =  hex2bin($iv);

        if ($action == 'encrypt') {
            $encryptedText = base64_encode(openssl_encrypt($string, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv));
            if (false === $encryptedText) {
                return openssl_error_string();
            }
            return $encryptedText;
        } else if ($action == 'decrypt') {
            $decrypted = openssl_decrypt($string, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            return trim($decrypted);
        }           
    }

    public static function cryptoJsAesEncrypt($passphrase, $value){
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx.$passphrase.$salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);
    }
}
