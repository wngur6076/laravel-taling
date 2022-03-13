<?php

return [
    'hosts' => [
        [
            'host' => env('ELASTICSEARCH_HOST', '172.17.0.1:9200'),
            'user' => env('ELASTICSEARCH_USER', ''),
            'pass' => env('ELASTICSEARCH_PASS', ''),
        ],
    ],
];
