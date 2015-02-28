<?php
// site config file
return [
    // backend config
    'backend' => [
	    'allowedIPS' => [
		    '127.0.0.1', '192.168.4.1'
	    ]

    ],
    // config for default images
    'static'        => [
        // error image location
        'error'  => '/assets/images/Error/imageNotFound.jpg',
        // default user avatar
        'avatar' => '/assets/images/default-avatar.jpg',
        // the ajax loader
        'ajax' => '/assets/images/ajax-loader.gif',
    ],
    // view composers
    'composers'     => [
        // do we?
        'cache'    => false,
        // how long should we cache? (minutes)
        'duration' => 20
    ],
    'quantity' => [
	    // the max quantity that can be displayed in a quantity dropdown
	    // if exceeded, we will display a text box for the user
	    'max_selectable' => 10,

    ],
    // config for models. dimensions are for the uploaded images
    'products'      => [

        'reduce'     => 3,
        'dimensions' => [
            'width'  => 750,
            'height' => 570
        ],
        'images'     => "/public/assets/images/products",
    ],
    'subcategories' => [

        'dimensions' => [
            'width'  => 870,
            'height' => 255
        ],
        'images'     => "/public/assets/images/banners/sub-categories",
    ],
    'categories'    => [

        'dimensions' => [
            'width'  => 870,
            'height' => 255
        ],
        'images'     => "/public/assets/images/banners/categories",
    ],
    'brands'        => [

        'dimensions' => [
            'width'  => 145,
            'height' => 50
        ],
        'images'     => "/public/assets/images/brands",
    ],
    'users'         => [

        'avatars' => '/public/assets/users/profilePics',
    ],
    'reviews'       => [
        // how many stars should we display for a rating?. Applies to both input and output
        'stars'   => 5,
        // how many stars should a 'hot' product have
        'hottest' => 4,
        // the total count of the hot stars. This count represents unique users who reviewed the product
        'count'   => 7
    ],
];