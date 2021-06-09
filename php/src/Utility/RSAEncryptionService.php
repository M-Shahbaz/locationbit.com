<?php

namespace App\Utility;

use phpseclib\Crypt\RSA;

final class RSAEncryptionService
{
    public static function crypt( $string, $action = 'encrypt', $rsaKey = null ) {
        
        $output = false;

        $rsa = new RSA();
        $rsa->loadKey($rsaKey); //Public or private key based on operation
        if( $action == 'encrypt' ) {
            
            $output = base64_encode( $rsa->encrypt($string) );
        }
        else if( $action == 'decrypt' ){
            $output = $rsa->decrypt( base64_decode( $string ) );
        }
    
        return $output;
    }
}