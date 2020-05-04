<?php

return [

    'use_cdn' => env('USE_CDN', true),

    'cdn_url' => 'https://cdn.royalanime.com',

    'filesystem' => [
        'disk' => 'asset-cdn',

        'options' => [
            //
        ],
    ],

    'files' => [
        'ignoreDotFiles' => true,

        'ignoreVCS' => true,

        'include' => [
            'paths' => [
                //
            ],
            'files' => [
                //
            ],
            'extensions' => [
                //
            ],
            'patterns' => [
                //
            ],
        ],

        'exclude' => [
            'paths' => [
                //
            ],
            'files' => [
                //
            ],
            'extensions' => [
                //
            ],
            'patterns' => [
                //
            ],
        ],
    ],

];
