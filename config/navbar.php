<?php

return [
    [
        'title'         => 'Home',
        'icon'          => 'bi bi-house-gear-fill',
        'route'         => 'dashboard',
    ],
    [
        'title'     => 'Categories',
        'icon'      => 'bi bi-tags-fill',
        'route'      => 'categories.index',
        'childrens'     =>
        [
            [
                'title'         => 'All',
                'icon'          => 'bi bi-tags-fill',
                'route'         => 'categories.index',
            ],
            [
                'title'         => 'Create New Category',
                'icon'          => 'bi bi-bookmark-plus',
                'route'         => 'categories.create',
            ]
        ],
    ],
];
