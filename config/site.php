<?php
// site config file
return [
    // config for default images
    'static' => [
        // error image location
        'error' => '/assets/images/Error/imageNotFound.jpg',
        // default user avatar
        'avatar' => '/assets/images/default-avatar.jpg',
        // the ajax loader
        'ajax' => '/assets/images/AjaxLoader_big.gif',
    ],

    // config for models. dimensions are for the uploaded images
    'products' => [

        'reduce' => 3,

        'dimensions' => [
            'width' => 750,
            'height' => 570
        ],

        'images' => "/public/assets/images/products",
    ],

    'subcategories' => [

        'dimensions' => [
            'width' => 90,
            'height' => 200
        ],

        'images' => "/public/assets/images/banners/sub-categories",
    ],

    'categories' => [

        'dimensions' => [
            'width' => 90,
            'height' => 200
        ],

        'images' => "/public/assets/images/banners/categories",
    ],

    'brands' => [

        'dimensions' => [
            'width' => 145,
            'height' => 50
        ],

        'images' => "/public/assets/images/brands",
    ],
    
    'users' => [

        'avatars' => '/public/assets/users/profilePics',
    ],

    'reviews' => [
        // how many stars should we display for a rating?
        'stars' => 5,
        // how many stars should a 'hot' product have
        'hottest' => 4,
        // after how many reviews, rated the no of stars above,  should a product be considered 'hot'
        'count' => 5
    ],
];