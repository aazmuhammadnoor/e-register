<?php

    return [

        'table' => 'visitor_registry',

        'ignored' => [
            'localhost',
        ],

        'maxmind_db_path' => storage_path().'/geo/GeoLite2-City.mmdb',

    ];
