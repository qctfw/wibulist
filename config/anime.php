<?php

return [
    'season' => [
        'minimum' => [
            'tv' => env('ANIME_SEASON_MINIMUM_TV'),
            'tv_continuing' => env('ANIME_SEASON_MINIMUM_TV_CONTINUING'),
            'ona' => env('ANIME_SEASON_MINIMUM_ONA'),
            'ova' => env('ANIME_SEASON_MINIMUM_OVA'),
            'movie' => env('ANIME_SEASON_MINIMUM_MOVIE'),
            'special' => env('ANIME_SEASON_MINIMUM_SPECIAL')
        ]
    ]
];