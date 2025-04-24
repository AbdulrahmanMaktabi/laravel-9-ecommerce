<?php

return [
    [
        'title'         => 'Home',
        'icon'          => 'bi bi-house-gear-fill',
        'route'         => 'dashboard',
    ],
    [
        'title'     => 'Products',
        'icon'      => 'bi bi-shop',
        'route'      => 'products.index',
        'childrens'     =>
        [
            [
                'title'         => 'All',
                'icon'          => 'bi bi-boxes',
                'route'         => 'products.index',
            ],
            [
                'title'         => 'Trashed Products',
                'icon'          => 'bi bi-boxes',
                'route'         => 'products.trash',
            ],
            [
                'title'         => 'Create New Product',
                'icon'          => 'bi bi-box-seam-fill',
                'route'         => 'categories.create',
            ]
        ],
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
                'title'         => 'Trashed Categories',
                'icon'          => 'bi bi-tags-fill',
                'route'         => 'categories.trash',
            ],
            [
                'title'         => 'Create New Category',
                'icon'          => 'bi bi-bookmark-plus',
                'route'         => 'categories.create',
            ]
        ],
    ],
];
