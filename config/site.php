<?php
// site config file
return [

    // backend config
    'backend' => [
        // ip addresses that can access the backend.
        'allowedIPS' => [
            '::1',
            '127.0.0.1',
        ],
        // only users with this roles will access the backend
        'allowedRoles' => [
            'Administrator',
            'Root',
            'Manager'
        ]

    ],

    // user account configs
    'account' => [
        // enable api login/ registration, ie login from fb, twitter, google, etc
        'api_login' => true,

        'api_registration' => true,
        // enforce account activation via email
        'activation' => true,
        // allow users to login, without activating their accounts
        'login_when_inactive' => false,
        // auto login the user, once they confirm/activate their account via email
        'auto_login_on_activate' => false,
    ],

    // config for default images
    'static' => [
        // error image location
        'error' => '/assets/images/Error/imageNotFound.jpg',
        // default user avatar
        'avatar' => '/assets/images/default-avatar.jpg',
        // the ajax loaders
        'ajax' => '/assets/images/ajax-loader.gif',

        'ajax2' => '/assets/images/alt-ajax-loader.gif',

        'ajax3' => '/assets/images/ajax-loader-large.gif',
    ],

    // view composers
    'composers' => [
        // specifies if caching should be done. This can be overridden in the composer itself
        'cache' => true,
        // how long should we cache? (minutes). Also this can be overridden in the composer itself
        'duration' => 20
    ],

    /* config for models */

    // ads
    'ads' => [

        'storage' => '/public/assets/images/ads'
    ],

    // products
    'products' => [
        // VAT
        'VAT' => 0.16,
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
        // product quantity
        'quantity' => [
            // the max quantity that can be displayed in a quantity dropdown
            // if exceeded, we will display a text box for the user
            'max_selectable' => 10,

            // the quantity of a product that will trigger a warning message
            'low_threshold' => 2,

        ],
        // product reviews
        'reviews' => [
            'display' => 5
        ]
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
            'storage' => '/public/assets/images/users/profilePics',
        ],

    ],

    // product reviews
    'reviews' => [
        // how many stars should we display for a rating?. Applies to both input and output
        'stars' => 5,
        // how many stars should a 'hot' product have
        'hottest' => 3,
        // the total count of the hot stars. This count represents unique users who reviewed the product
        'count' => 2
    ],
];