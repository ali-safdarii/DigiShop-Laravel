<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    //index size
    'index-image-sizes' => [
        'large' => [
            'width' => 1920,
            'height' => 1080
        ],
         'medium' => [
            'width' => 800,
            'height' => 800
        ],
         'small' => [
            'width' => 600,
            'height' => 600
        ],

    ],

    'default-current-index-image' => 'medium',


    'cache-image-sizes' => [
        'large' => [
            'width' => 1920,
            'height' => 1080
        ],
         'medium' => [
            'width' => 800,
            'height' => 600
        ],
         'small' => [
            'width' => 100,
            'height' => 100
        ],

    ],

    'default-current-cache-image' => 'medium',

    'image-cache-life-time' => 10,

    'image-not-found' => ''

];
