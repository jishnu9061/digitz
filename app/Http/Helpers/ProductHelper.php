<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/13
 * Time: 15:26:32
 * Description: ToastrHelper.php
 */

namespace App\Http\Helpers;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;

class ProductHelper
{
    public static function getProductImagePath($imageName)
    {
        $file = asset('images/image/7.jpg');
        if (null != $imageName) {
            if (FileManager::checkFileExist($imageName, FileDestinations::PRODUCT_IMAGE)) {
                $file = FileManager::getFileUrl($imageName, FileDestinations::PRODUCT_IMAGE);
            }
        }
        return $file;
    }
}
