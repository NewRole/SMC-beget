<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'external_api' => [
        'base_url' => env('API_BASE_URL', 'https://dev.rp.tkf.su/api/get_data.php?func=gr&PeriodType=Month&PeriodStart=2025-02-01&PeriodEnd=2025-02-28&NewbeeFilter=0'),
        'timeout' => env('API_TIMEOUT', 15)
    ],
'ratings_api' => [
    'endpoint' => env('RATINGS_API_ENDPOINT'),
    'timeout' => env('RATINGS_API_TIMEOUT'),
    'cache_ttl' => env('RATINGS_CACHE_TTL'),
    'params' => [
        'count' => env('RATINGS_DEFAULT_COUNT', 10),
        'sort' => env('RATINGS_DEFAULT_SORT', 'vr'),
        'order' => env('RATINGS_DEFAULT_ORDER', 'desc')
    ]
]
];
