<?php

return [
    [
        'title'         => 'Home',
        'icon'          => 'bi bi-house-gear-fill',
        'route'         => 'dashboard',
        'ability'       => 'dashboar.view'
    ],
    [
        'title'         => 'Settings',
        'icon'          => 'bi bi-gear-fill',
        'route'         => '#',
        'ability'   =>  'settings.view',
        'childrens'     =>
        [
            [
                'title'     => '2FA',
                'icon'      => 'bi bi-shield-lock',
                'route'     => 'admin.two-factor-auth',
                'ability'   =>  'settings.view'
            ]
        ]
    ],
    [
        'title'     => 'Products',
        'icon'      => 'bi bi-shop',
        'route'      => 'products.index',
        'ability'       =>  'products.view',
        'childrens'     =>
        [
            [
                'title'         => 'All',
                'icon'          => 'bi bi-boxes',
                'route'         => 'products.index',
                'ability'       =>  'products.view'

            ],
            [
                'title'         => 'Trashed Products',
                'icon'          => 'bi bi-boxes',
                'route'         => 'products.trash',
                'ability'       =>  'products.trash'

            ],
            [
                'title'         => 'Create New Product',
                'icon'          => 'bi bi-box-seam-fill',
                'route'         => 'products.create',
                'ability'       =>  'products.create'

            ]
        ],
    ],
    [
        'title'     => 'Categories',
        'icon'      => 'bi bi-tags-fill',
        'route'      => 'categories.index',
        'ability'       =>  'categories.view',
        'childrens'     =>
        [
            [
                'title'         => 'All',
                'icon'          => 'bi bi-tags-fill',
                'route'         => 'categories.index',
                'ability'       =>  'categories.view'

            ],
            [
                'title'         => 'Trashed Categories',
                'icon'          => 'bi bi-tags-fill',
                'route'         => 'categories.trash',
                'ability'       =>  'categories.view'

            ],
            [
                'title'         => 'Create New Category',
                'icon'          => 'bi bi-bookmark-plus',
                'route'         => 'categories.create',
                'ability'       =>  'categories.create'

            ]
        ],
    ],
    [
        'title'     => 'Users',
        'icon'      => 'bi bi-people',
        'route'      => 'users.index',
        'ability'    =>  'users.view',
        'childrens' => [
            [
                'title'     => 'Users',
                'icon'      => 'bi bi-people',
                'route'      => 'users.index',
                'ability'    =>  'users.view'

            ],
            [
                'title'     => 'Admins',
                'icon'      => 'bi bi-person-up',
                'route'      => 'admins.index',
                'ability'    =>  'admins.view'

            ],

        ]
    ],
    [
        'title'     => 'Roles',
        'icon'      => 'bi bi-lock-fill',
        'route'      => 'roles.index',
        'ability'    =>  'roles.view',
        'childrens' => [
            [
                'title'     => 'All',
                'icon'      => 'bi bi-lock-fill',
                'route'      => 'roles.index',
                'ability'    =>  'roles.view'

            ],
            [
                'title'     => 'Create',
                'icon'      => 'bi bi-lock-fill',
                'route'      => 'roles.create',
                'ability'    =>  'roles.create'

            ],
        ]
    ],
];
