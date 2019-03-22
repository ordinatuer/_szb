<?php

return [
    'view' => 'szb-admin-short',
    'vendors' => [
        'yandex' => [
            'css' => [
                'zb-y-css',
            ],
            'js' => [
                'map-api' => 'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
                'szb-admin' => 'szb-admin',
            ],
            'view' => 'zbview-y',
        ],
        '2gis' => [
            'css' => [
                'zb-dg-styles',
            ],
            'js' => [
                'map-api' => 'http://maps.api.2gis.ru/2.0/loader.js?pkg=full',
                'szb-admin',
            ],
            'view' => 'zbview-dg',
        ],
    ],
    'type' => 'Short',
    'default' => [
        'vendor' => 'yandex',
        'zoom' => '9',
        'lon' => '54.99244',
        'lat' => '73.36859',
    ],
];