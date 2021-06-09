<?php

namespace App\Utility;

final class Base64SafeUrlService
{
    public static function encode($s) {
        return str_replace(array('+', '/'), array('-', '_'), $s);
    }
    
    public static function decode($s) {
        return str_replace(array('-', '_'), array('+', '/'), $s);
    }
}
