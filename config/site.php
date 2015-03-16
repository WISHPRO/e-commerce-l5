<?php
// site config file
return [

    // backend config
    'backend' => [
        // ip addresses that can access the backend.
        // defaults are the locally available ones
        'allowedIPS' => [
            '::1',
            '127.0.0.1',
        ],
        // only users with this roles will access the backend
        'allowedRoles' => [
            'Administrator',
        ]

    ],

    // user account configs
    'account' => [
        // enforce account activation via email
        'activation' => true,
        // allow users to login, without activating their accounts
        'login_when_inactive' => false
    ],

    // config for default images
    'static' => [
        // error image location
        'error' => '/assets/images/Error/imageNotFound.jpg',
        // default user avatar
        'avatar' => '/assets/images/default-avatar.jpg',
        // the ajax loader
        'ajax' => '/assets/images/ajax-loader.gif',
    ],

    // view composers
    'composers' => [
        // specifies if caching should be done. This can be overridden in the composer itself
        'cache' => true,
        // how long should we cache? (minutes). Also this can be overridden in the composer itself
        'duration' => 20
    ],

    // product quantity
    'quantity' => [
        // the max quantity that can be displayed in a quantity dropdown
        // if exceeded, we will display a text box for the user
        'max_selectable' => 10,

    ],

    /* config for models */

    // ads
    'ads' => [
        'dimensions' => [
            'width' => 1200,
            'height' => 400
        ],
        'storage' => '/public/assets/images/ads'
    ],

    // products
    'products' => [
        // VAT percent
        'VAT' => 16,
        // at which amount (KSH) should a product be considered taxable
        'taxableThreshold' => 2000,
        // product images
        'images' => [
            // image resize ratio -> big:small. This is evident since a product will have two images,
            // one small and the other large
            'reduce_ratio' => 3,
            // resize dimensions
            'dimensions' => [
                'width' => 1920,
                'height' => 1080
            ],
            // image storage area
            'storage' => "/public/assets/images/products",
        ],
    ],

    // subcategories
    'subcategories' => [

        'images' => [
            // resize dimensions
            'dimensions' => [
                'width' => 870,
                'height' => 255
            ],
            // image storage area
            'storage' => "/public/assets/images/banners/sub-categories",
        ],

    ],

    // categories
    'categories' => [

        'images' => [
            // resize dimensions
            'dimensions' => [
                'width' => 870,
                'height' => 255
            ],
            // storage area
            'storage' => "/public/assets/images/banners/categories",
        ],

    ],

    // product brands
    'brands' => [

        'images' => [
            // resize dimensions
            'dimensions' => [
                'width' => 220,
                'height' => 110
            ],
            // storage area
            'storage' => "/public/assets/images/brands",
        ],

    ],

    // system users
    'users' => [

        'images' => [
            // storage
            'storage' => '/public/assets/users/profilePics',
        ],

    ],

    // product reviews
    'reviews' => [
        // how many stars should we display for a rating?. Applies to both input and output
        'stars' => 5,
        // how many stars should a 'hot' product have
        'hottest' => 4,
        // the total count of the hot stars. This count represents unique users who reviewed the product
        'count' => 7
    ],
];