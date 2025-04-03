<?php
return [
    'ratings' => [
        'endpoint' => env('RATINGS_API_ENDPOINT', 'https://dev.rp.tkf.su/api/get_data.php?func=gr&PeriodType=Month&PeriodStart=2025-02-01&PeriodEnd=2025-02-28&NewbeeFilter=0'),
        'timeout' => env('RATINGS_API_TIMEOUT', 15),
        'cache_ttl' => env('RATINGS_CACHE_TTL', 60),
        'params' => [
            'count' => 10,
            'sort' => 'vr',
            'order' => 'desc'
        ]
    ]
];
