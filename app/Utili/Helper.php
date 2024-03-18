<?php

namespace App\Utili;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Helper
{

    static $numberOfSeeder = 200;
    public static function getcurrentImage($item, $size = 'medium')
    {

        if (isset($item->image['indexArray']) && isset($item->image['indexArray'][$size])) {

            return $item->image['indexArray'][$size];

        } else {
            $image = Image::make(public_path('admin/images/not_found.png'));

            $image->resize(50, 50);

            $image->save(public_path('admin/images/not_found_50x50.jpg'));

            return asset('admin/images/not_found_50x50.jpg');

        }
    }

    public static function limitStr($value,$limit_val = 15)
    {
      return Str::limit($value, $limit = $limit_val, $end = '...');
    }


    function priceFormat($price) {

       return $price = number_format($price,0,'.',',');

    }
}
