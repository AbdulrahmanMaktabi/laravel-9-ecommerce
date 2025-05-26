<?php

return [
    [
        'title'         => 'Home',
        'icon'          => 'bi bi-house-gear-fill',
        'route'         => 'dashboard',
    ],
    [
        'title'         => 'Settings',
        'icon'          => 'bi bi-gear-fill',
        'route'         => '#',
        'childrens'     =>
        [
            [
                'title' => '2FA',
                'icon'  => 'bi bi-shield-lock',
                'route' => 'admin.two-factor-auth',
            ]
        ]
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
                'route'         => 'products.create',
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
    [
        'title'     => 'Users',
        'icon'      => 'bi bi-people',
        'route'      => 'users..index',
        'childrens' => [
            [
                'title'     => 'Users',
                'icon'      => 'bi bi-people',
                'route'      => 'users.index',
            ],
            [
                'title'     => 'Admins',
                'icon'      => 'bi bi-person-up',
                'route'      => 'admins.index',
            ],

        ]
    ],
    [
        'title'     => 'Roles',
        'icon'      => 'bi bi-lock-fill',
        'route'      => 'roles.index',
        'childrens' => [
            [
                'title'     => 'All',
                'icon'      => 'bi bi-lock-fill',
                'route'      => 'roles.index',
            ],
            [
                'title'     => 'Create',
                'icon'      => 'bi bi-lock-fill',
                'route'      => 'roles.create',
            ],
        ]
    ],
];
