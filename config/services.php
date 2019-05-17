<?php
/**
 * Fetching the list of from the micro service
 * @param void
 * @return string $base_uri
 */
return [
    'examples' => [
        'base_uri' => env('EXAMPLES_SERVICE_BASE_URL'),
    ],
    'authorization' => [
        'base_uri' => env('AUTHORIZATION_SERVICE_BASE_URL'),
    ],
];
