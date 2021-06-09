<?php

namespace App\Utility;

use Endroid\QrCode\QrCode;
use Ramsey\Uuid\Nonstandard\Uuid;
use Exception;

/**
 * Service.
 */
final class QrCodeService
{
    public static function fromText($text, $fileName = null, $fileSufix = 'png')
    {
       try{
        $fileName = $fileName ?? Uuid::uuid4()->toString();
        $file = TEMP_FOLDER."{$fileName}.{$fileSufix}";
        $qrCode = new QrCode($text);
        $qrCode->setEncoding('UTF-8');
        $qrCode->writeFile("{$file}");
        return $file;
       } catch (Exception $e) {
            return false;
       }
    }
}