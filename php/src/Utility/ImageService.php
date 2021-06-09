<?php

namespace App\Utility;

final class ImageService
{
    public static function getDataURI($image) {
        $type = pathinfo(IMAGE_FOLDER.$image, PATHINFO_EXTENSION);
        $data = file_get_contents(IMAGE_FOLDER.$image);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}

